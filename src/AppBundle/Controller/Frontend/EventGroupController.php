<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Event;
use AppBundle\Entity\Group;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @throws NotFoundHttpException
     *
     * @Method("GET")
     * @Route("/events/{slug}")
     * @ParamConverter("event", class="AppBundle:Event")
     */
    public function eventAction(Event $event)
    {
        $eventGroups = $this->getDoctrine()->getRepository('AppBundle:EventGroup')->getGroupsForEvent($event->getId());

        if ($eventGroups != null) {

            return $this->render('AppBundle:frontend\event-groups:events.html.twig', [
                'eventGroups' => $eventGroups
            ]);
        } else {
            throw $this->createNotFoundException('The groups does not exist');
        }
    }

    /**
     * Get all events for group
     *
     * @return Response
     *
     * @throws NotFoundHttpException
     *
     * @Method("GET")
     * @Route("/groups/{slug}")
     * @ParamConverter("group", class="AppBundle:Group")
     */
    public function groupAction(Group $group)
    {
        $eventGroups = $this->getDoctrine()->getRepository('AppBundle:EventGroup')->getEventsForGroup($group->getId());

        if ($eventGroups != null) {

            return $this->render('AppBundle:frontend\event-groups:group.html.twig', [
                'eventGroups' => $eventGroups
            ]);
        } else {
            throw $this->createNotFoundException('The events does not exist');
        }
    }
}