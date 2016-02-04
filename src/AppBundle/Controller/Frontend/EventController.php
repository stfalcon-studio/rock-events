<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Event;
use AppBundle\Entity\Group;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findEventsForWeek();

        return $this->render('AppBundle:frontend/event:index.html.twig', [
            'events' => $events,
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

        return $this->render('AppBundle:frontend\event:list.html.twig', [
            'events' => $events,
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

        return $this->render('AppBundle:frontend\event:show.html.twig', [
            'event'  => $event,
            'groups' => $groups,
        ]);
    }

    /**
     * Recommended concert widget
     *
     * @param Group $group
     *
     * @return Response
     */
    public function recommendedConcertsAction(Group $group)
    {
        $user = $this->getUser();
        if (null === $user) {
            $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findEventsForWeek();

            return $this->render('AppBundle:frontend/event:recommended-concerts.html.twig', [
                'events' => $events,
            ]);
        }

        $genres = $this->getDoctrine()->getRepository('AppBundle:Genre')->findGenresByGroup($group);
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findEventsBySimilarGenres($genres);
        if (Event::NUMBER > count($events)) {
            $eventsByUserBookmark = $this->getDoctrine()->getRepository('AppBundle:Event')->findEventsByUserBookMark($user);
            foreach ($events as $event) {
                if (Event::NUMBER > count($events)) {
                    break;
                }
                foreach ($eventsByUserBookmark as $eventByUserBookmark) {
                    if ($event->getId() === $eventByUserBookmark->getId()) {
                        $events[] = $eventByUserBookmark;
                    }
                }
            }

            if (Event::NUMBER > count($events)) {
                $eventsForWeek = $this->getDoctrine()->getRepository('AppBundle:Event')->findEventsForWeek();
                foreach ($eventsForWeek as $eventForWeek) {
                    if (!in_array($eventForWeek, $events)) {
                        $events[] = $eventForWeek;
                    }
                }
            }
        }

        return $this->render('AppBundle:frontend/event:recommended-concerts.html.twig', [
            'events' => $events,
        ]);
    }
}
