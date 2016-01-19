<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Event;
use AppBundle\Entity\Group;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Frontend EventController
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @Route("/event-groups")
 */
class EventGroupController extends Controller
{
    /**
     * Event Groups list
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/", name="event-groups-index")
     */
    public function indexAction()
    {
        $eventGroups = $this->getDoctrine()->getRepository('AppBundle:EventGroup')->getAllActualEventGroup();

        return $this->render('AppBundle:frontend\event-groups:index.html.twig', [
            'eventGroups' => $eventGroups,
        ]);
    }

    /**
     * Get all groups for event
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/events/{slug}")
     */
    public function eventAction(Event $slug)
    {
        $eventGroups = $this->getDoctrine()->getRepository('AppBundle:EventGroup')->getGroupsForEvent($slug->getId());

        return $this->render('AppBundle:frontend\event-groups:events.html.twig', [
            'eventGroups' => $eventGroups
        ]);
    }

    /**
     * Get all events for group
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/groups/{slug}")
     */
    public function groupAction(Group $slug)
    {
        $eventGroups = $this->getDoctrine()->getRepository('AppBundle:EventGroup')->getEventsForGroup($slug->getId());

        return $this->render('AppBundle:frontend\event-groups:group.html.twig', [
            'eventGroups' => $eventGroups
        ]);
    }
}