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
 *
 * @Route("/events")
 */
class EventController extends Controller
{
    /**
     * Event list
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/", name="events_index")
     */
    public function indexAction()
    {
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findAll();

        return $this->render('AppBundle:frontend\event:index.html.twig', [
            'events' => $events,
        ]);
    }

    /**
     * Event show
     *
     * @param Event $slug
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/{slug}", name="events_show")
     * @ParamConverter("event", class="AppBundle:Event")
     */
    public function showAction(Event $event)
    {
        $groups = $this->getDoctrine()->getRepository('AppBundle:Event')->getGroups($event->getId());

        return $this->render('AppBundle:frontend\event:show.html.twig', [
            'event'  => $event,
            'groups' => $groups
        ]);
    }
}