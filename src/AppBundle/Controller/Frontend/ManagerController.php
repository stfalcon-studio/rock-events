<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\ManagerGroup;
use AppBundle\Form\Entity\Event as EventForm;
use AppBundle\Entity\Event;
use AppBundle\Entity\EventGroup;
use AppBundle\Entity\Group;
use AppBundle\Form\Entity\Group as GroupForm;
use AppBundle\Form\Type\GroupType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Frontend ManagerController
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class ManagerController extends Controller
{
    /**
     * Manager dashboard
     *
     * @return Response
     *
     * @Route("/manager", name="manager_cabinet_dashboard")
     */
    public function dashboardAction()
    {
        return $this->render('AppBundle:frontend/manager:dashboard.html.twig');
    }

    /**
     * Add new group
     *
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/manager/group/create", name="manager_cabinet_group_create")
     */
    public function addGroupAction(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm('group', null, [
            'action' => $this->generateUrl('manager_cabinet_group_create'),
        ]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var \AppBundle\Form\Entity\Group $groupForm */
            $groupForm = $form->getData();

            $managerService = $this->get('app.manager');
            $managerService->saveGroupOnCreate($groupForm, $user);

            return $this->redirectToRoute('manager_cabinet_dashboard');
        }

        return $this->render('AppBundle:frontend/manager:group_create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Update group
     *
     * @param Request $request $request
     * @param Group   $group   Group
     *
     * @return Response
     *
     * @Route("/manager/group/{slug}/update", name="manager_cabinet_group_update")
     * @ParamConverter("group", class="AppBundle:Group")
     */
    public function updateGroupAction(Request $request, Group $group)
    {
        $em   = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $managerService = $this->get('app.manager');

        $groupForm = $managerService->convertToGroupForm($group);

        $form = $this->createForm(new GroupType($em), $groupForm);
        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var \AppBundle\Form\Entity\Group $groupForm */
            $groupForm = $form->getData();

            $managerService->saveGroupOnUpdate($groupForm, $group, $user);

            return $this->redirectToRoute('manager_cabinet_dashboard');
        }

        return $this->render('AppBundle:frontend/manager:group_update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Manager list groups
     *
     * @Route("/manager/groups", name="manager_cabinet_groups_list")
     *
     * @return Response
     */
    public function groupsAction()
    {
        $groups = $this->getDoctrine()->getRepository('AppBundle:Group')->findGroupsByManager($this->getUser());

        return $this->render('AppBundle:frontend/manager:group_list.html.twig', [
            'groups' => $groups,
        ]);
    }

    /**
     * Manager list events for group
     *
     * @param Group $group Group
     *
     * @return Response
     *
     * @Route("/manager/group/{slug}/events", name="manager_cabinet_group_events")
     * @ParamConverter("group", class="AppBundle:Group")
     */
    public function groupEventAction(Group $group)
    {
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findEventsByGroup($group);

        return $this->render('AppBundle:frontend/manager:group_events.html.twig', [
            'group'  => $group,
            'events' => $events,
        ]);
    }

    /**
     * Add new event
     *
     * @param Request $request Request
     *
     * @return Response
     *
     * @Route("/manager/event/create", name="manager_cabinet_event_create")
     */
    public function addEventAction(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm('event_groups', null, [
            'action' => $this->generateUrl('manager_cabinet_event_create'),
        ]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var EventForm $eventForm */
            $eventForm = $form->getData();

            $managerService = $this->get('app.manager');
            $managerService->saveEventOnCreate($eventForm, $user);

            return $this->redirectToRoute('manager_cabinet_dashboard');
        }

        return $this->render('AppBundle:frontend/manager:event_create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Update Event
     *
     * @param Event   $event   Event
     * @param Request $request Request
     *
     * @return Response
     *
     * @Route("/manager/event/{slug}/update", name="manager_cabinet_event_update")
     * @ParamConverter("event", class="AppBundle:Event")
     */
    public function updateEvent(Event $event, Request $request)
    {
        $user   = $this->getUser();
        $groups = $this->getDoctrine()->getRepository('AppBundle:Group')->findGroupsByEvent($event);

        $managerService = $this->get('app.manager');

        $eventForm = $managerService->convertToEventForm($event);

        $form = $this->createForm('event_groups', $eventForm, [
            'action' => $this->generateUrl('manager_cabinet_event_update', ['slug' => $event->getSlug()]),
        ]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            /** @var EventForm $eventForm */
            $eventForm = $form->getData();

            $managerService->saveEventOnUpdate($eventForm, $event, $user);

            return $this->redirectToRoute('manager_cabinet_dashboard');
        }

        return $this->render('AppBundle:frontend/manager:event_update.html.twig', [
            'form'   => $form->createView(),
            'groups' => $groups,
        ]);
    }

    /**
     * Manager list all actual events
     *
     * @return Response
     *
     * @Route("/manager/events", name="manager_cabinet_events_list")
     */
    public function listEventsAction()
    {
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findEventsByManager($this->getUser());

        return $this->render('AppBundle:frontend/manager:event_list.html.twig', [
            'events' => $events,
        ]);
    }

    /**
     * Manager list all previous events
     *
     * @return Response
     *
     * @Route("manager/events/previous", name="manager_cabinet_events_list_previous")
     */
    public function listPreviousEventsAction()
    {
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findPreviousEventsByManager($this->getUser());

        return $this->render('AppBundle:frontend/manager:event_list_previous.html.twig', [
            'events' => $events,
        ]);
    }
}
