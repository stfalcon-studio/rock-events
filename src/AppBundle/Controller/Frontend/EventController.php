<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Event;
use AppBundle\Entity\EventGroup;
use AppBundle\Entity\Group;
use AppBundle\Entity\GroupGenre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Frontend EventController
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class EventController extends Controller
{
    /**
     * Event index
     *
     * @return Response
     *
     * @Route("/", name="event_index")
     */
    public function indexAction()
    {
        $eventRepository = $this->getDoctrine()->getRepository('AppBundle:Event');
        $genreRepository = $this->getDoctrine()->getRepository('AppBundle:Genre');

        $events = $eventRepository->findActualEvents();
        $genres = $genreRepository->findAllActiveGenres();
        $cities = $eventRepository->findAllCityByEvents();

        return $this->render('AppBundle:frontend/event:index.html.twig', [
            'events' => $events,
            'genres' => $genres,
            'cities' => $cities,
        ]);
    }

    /**
     * Event list
     *
     * @return Response
     *
     * @Route("/events", name="event_list")
     */
    public function listAction()
    {
        $eventRepository = $this->getDoctrine()->getRepository('AppBundle:Event');
        $genreRepository = $this->getDoctrine()->getRepository('AppBundle:Genre');

        $events = $eventRepository->findActualEvents();
        $genres = $genreRepository->findAllActiveGenres();
        $cities = $eventRepository->findAllCityByEvents();

        return $this->render('AppBundle:frontend\event:list.html.twig', [
            'events' => $events,
            'genres' => $genres,
            'cities' => $cities,
        ]);
    }

    /**
     * Event show
     *
     * @param Event $event Event
     *
     * @return Response
     *
     * @Route("/event/{slug}", name="event_show")
     * @ParamConverter("event", class="AppBundle:Event")
     */
    public function showAction(Event $event)
    {
        $groups = $this->getDoctrine()->getRepository('AppBundle:Group')->findGroupsByEvent($event);

        $timeToEvent = (new \DateTime())->diff($event->getBeginAt());

        return $this->render('AppBundle:frontend\event:show.html.twig', [
            'event'             => $event,
            'groups'            => $groups,
            // @todo Change to many groups
            'recommended_group' => $groups[0],
            'time_to_event'     => $timeToEvent,
        ]);
    }

    /**
     * Recommended events widget
     *
     * @param Event $event Event
     *
     * @return Response
     */
    public function recommendedConcertsAction(Event $event)
    {
        $eventRepository = $this->getDoctrine()->getRepository('AppBundle:Event');
        $genreRepository = $this->getDoctrine()->getRepository('AppBundle:Genre');
        $groupRepository = $this->getDoctrine()->getRepository('AppBundle:Group');

        $user = $this->getUser();
        if (null === $user) {
            $events = $eventRepository->findEventsForWeek(Event::NUMBER);

            return $this->render('AppBundle:frontend/event:recommended-concerts.html.twig', [
                'events' => $events,
            ]);
        }

        $eventGenres = [];
        $eventGroups = [];

        /** @var EventGroup $eventGroup */
        foreach ($event->getEventGroups()->getValues() as $eventGroup) {
            $groupGenres = $eventGroup->getGroup()->getGroupGenres();

            // Get groups from event
            $eventGroups[] = $eventGroup->getGroup();

            /** @var GroupGenre $groupGenre */
            foreach ($groupGenres as $groupGenre) {
                // Get genres from event
                $eventGenres[] = $groupGenre->getGenre();
            }
        }

        // Get user bookmarked genres and groups
        $userBookmarkedGenres = $genreRepository->findGenresByUser($user);
        $userBookmarkedGroups = $groupRepository->findGroupsByUser($user);

        // Combine event genres and groups with user bookmarked genres and groups
        $recommendedGenres = array_merge($userBookmarkedGenres, $eventGenres);
        $recommendedGroups = array_merge($userBookmarkedGroups, $eventGroups);

        $events = $eventRepository->findAllActiveByGenresAndGroupsWithLimit(
            $recommendedGenres,
            $recommendedGroups,
            Event::NUMBER
        );

        return $this->render('AppBundle:frontend/event:recommended-concerts.html.twig', [
            'events' => $events,
        ]);
    }

    /**
     * Return last events
     *
     * @return Response
     */
    public function lastEventsAction()
    {
        $lastEvents = $this->getDoctrine()->getRepository('AppBundle:Event')->findPreviousEvents();

        return $this->render('AppBundle:frontend/event:last_events.html.twig', [
            'events' => $lastEvents,
        ]);
    }

    /**
     * Return popular events
     *
     * @return Response
     */
    public function popularEventsAction()
    {
        $popularEvents = $this->getDoctrine()->getRepository('AppBundle:Event')->findActualEvents(5);

        return $this->render('AppBundle:frontend/event:popular_events.html.twig', [
            'events' => $popularEvents,
        ]);
    }

    /**
     * List events for main page
     *
     * @param array $events Array of events
     *
     * @return Response
     */
    public function listMainEventAction($events)
    {
        return $this->render('AppBundle:frontend/event:list_main_event.html.twig', [
            'events' => $events,
        ]);
    }

    /**
     * List events for concert page
     *
     * @param array $events Array of events
     *
     * @return Response
     */
    public function listConcertEventAction($events)
    {
        return $this->render('AppBundle:frontend/event:list_concert_event.html.twig', [
            'events' => $events,
        ]);
    }

    /**
     * Ajax filter for event
     *
     * @param Request $request Request
     *
     * @throws BadRequestHttpException
     *
     * @return Event[]
     *
     * @Route("/concert-filters", name="event_filters")
     */
    public function ajaxEventFilter(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Не правильний запит');
        }

        $genre = $request->query->get('genre');
        $city  = $request->query->get('city');
        $date  = $request->query->get('date');

        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findEventsByFilter($genre, $city, $date);

        $template = $this->renderView('AppBundle:frontend/event:list_concert_event.html.twig', [
            'events' => $events,
        ]);

        return new JsonResponse([
            'status'   => true,
            'message'  => 'Success',
            'template' => $template,
        ]);
    }

    /**
     * Ajax filter for main page
     *
     * @param Request $request Request
     *
     * @throws BadRequestHttpException
     *
     * @return Event[]
     *
     * @Route("/main-filters", name="main_filters")
     */
    public function ajaxMainFilter(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Не правильний запит');
        }

        $genre = $request->query->get('genre');
        $city  = $request->query->get('city');
        $date  = $request->query->get('date');

        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findEventsByFilter($genre, $city, $date);

        $template = $this->renderView('AppBundle:frontend/event:list_main_event.html.twig', [
            'events' => $events,
        ]);

        return new JsonResponse([
            'status'   => true,
            'message'  => 'Success',
            'template' => $template,
        ]);
    }
}
