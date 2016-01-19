<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Event;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Frontend EventController
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @Route("/events")
 */
class EventController extends BaseController
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
        $events = $this->getRepository("AppBundle:Event")->findAll();

        return $this->render('AppBundle:frontend\event:index.html.twig', [
            'events' => $events,
        ]);
    }

    /**
     * Event show
     *
     * @param Event $event
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/{id}", requirements={"id" = "\d+"}, name="events_show")
     */
    public function showAction(Event $event)
    {
        return $this->render('AppBundle:frontend\event:show.html.twig', [
            'event' => $event,
        ]);
    }
}