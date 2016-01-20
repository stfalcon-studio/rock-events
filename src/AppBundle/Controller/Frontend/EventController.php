<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Event;
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
     * @Method("GET")
     * @Route("/", name="event_index")
     */
    public function indexAction()
    {
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->getEventsForWeek();

        return $this->render('AppBundle:frontend/event:index.html.twig', [
            'events' => $events
        ]);
    }

    /**
     * Event list
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/events", name="event_list")
     */
    public function listAction()
    {
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->getActualEvents();

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
     * @Method("GET")
     * @Route("/event/{slug}", name="event_show")
     * @ParamConverter("event", class="AppBundle:Event")
     */
    public function showAction(Event $event)
    {
        $groups = $this->getDoctrine()->getRepository('AppBundle:Event')->getGroups($event);

        return $this->render('AppBundle:frontend\event:show.html.twig', [
            'event'  => $event,
            'groups' => $groups
        ]);
    }
}