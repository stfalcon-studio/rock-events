<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Event;
use AppBundle\Entity\Group;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Frontend EventController
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
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
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findActualEvents();
        $genres = $this->getDoctrine()->getRepository('AppBundle:Genre')->findAll();
        $cities = $this->getDoctrine()->getRepository('AppBundle:Event')->findAllCityByEvents();

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
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findActualEvents();
        $genres = $this->getDoctrine()->getRepository('AppBundle:Genre')->findAll();
        $cities = $this->getDoctrine()->getRepository('AppBundle:Event')->findAllCityByEvents();

        return $this->render('AppBundle:frontend\event:list.html.twig', [
            'events' => $events,
            'genres' => $genres,
            'cities' => $cities,
        ]);
    }

    /**
     * Event show
     *
     * @param Event $slug Event
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
            'event'                => $event,
            'groups'               => $groups,
            'recommended_group'    => $groups[0], // @todo Change to many groups
            'time_to_event_day'    => $timeToEvent->format('%d'),
            'time_to_event_hour'   => $timeToEvent->format('%h'),
            'time_to_event_minute' => $timeToEvent->format('%i'),
        ]);
    }

    /**
     * Recommended concert widget
     *
     * @param Group $group Group
     *
     * @return Response
     */
    public function recommendedConcertsAction(Group $group)
    {
        $user = $this->getUser();
        if (null === $user) {
            $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findEventsForWeek();
            if (Event::NUMBER < count($events)) {
                $events = array_slice($events, 0, Event::NUMBER);
            }

            return $this->render('AppBundle:frontend/event:recommended-concerts.html.twig', [
                'events' => $events,
            ]);
        }

        $genres = $this->getDoctrine()->getRepository('AppBundle:Genre')->findGenresByGroup($group);
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findEventsBySimilarGenres($genres);

        // @todo Refactoring
        if (Event::NUMBER > count($events)) {
            $eventsByUserBookmark = $this->getDoctrine()->getRepository('AppBundle:Event')
                                         ->findEventsByUserBookMark($user);
            foreach ($events as $event) {
                foreach ($eventsByUserBookmark as $eventByUserBookmark) {
                    if ($event->getId() === $eventByUserBookmark->getId()) {
                        $events[] = $eventByUserBookmark;
                        if (Event::NUMBER <= count($events)) {
                            break;
                        }
                    }
                }
            }

            if (Event::NUMBER > count($events)) {
                $eventsForWeek = $this->getDoctrine()->getRepository('AppBundle:Event')->findEventsForWeek();
                foreach ($eventsForWeek as $eventForWeek) {
                    if (!in_array($eventForWeek, $events)) {
                        $events[] = $eventForWeek;
                        if (Event::NUMBER <= count($events)) {
                            break;
                        }
                    }
                }
            }
        } else {
            $events = array_slice($events, 0, Event::NUMBER);
        }

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
     * Return list event for main page
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
     * Return list event for main page
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
     * @throws BadRequestHttpException Bab request 400 Request only AJAX
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
     * @throws BadRequestHttpException Bab request 400 Request only AJAX
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
