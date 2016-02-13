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
        $em   = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $form = $this->createForm('group');
        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var \AppBundle\Form\Entity\Group $groupForm */
            $groupForm = $form->getData();

            $group = (new Group())
                ->setName($groupForm->getName())
                ->setDescription($groupForm->getDescription())
                ->setCountry($groupForm->getCountry())
                ->setCity($groupForm->getCity())
                ->setSlug($groupForm->getName())
                ->setImageName($groupForm->getImageName())
                ->setFoundedAt((new \DateTime())->setDate($groupForm->getFoundedAt(), 1, 1))
                ->setCreatedBy($user)
                ->setUpdatedBy($user);

            $managerGroup = (new ManagerGroup())
                ->setGroup($group)
                ->setManager($user);

            $em->persist($group);
            $em->persist($managerGroup);
            $em->flush();
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

        $groupForm = (new GroupForm())
            ->setName($group->getName())
            ->setDescription($group->getDescription())
            ->setFoundedAt($group->getFoundedAt()->format('Y'));

        $form = $this->createForm(new GroupType($em), $groupForm);
        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var \AppBundle\Form\Entity\Group $groupForm */
            $groupForm = $form->getData();

            $managerGroup = $em->getRepository('AppBundle:ManagerGroup')->findOneBy([
                'group' => $group,
            ]);

            $group->setName($groupForm->getName())
                  ->setDescription($groupForm->getDescription())
                  ->setCountry($groupForm->getCountry())
                  ->setCity($groupForm->getCity())
                  ->setSlug($groupForm->getName())
                  ->setFoundedAt((new \DateTime())->setDate($groupForm->getFoundedAt(), 1, 1))
                  ->setCreatedBy($user)
                  ->setUpdatedBy($user);

            $managerGroup->setGroup($group);

            $em->persist($group);
            $em->persist($managerGroup);

            $em->flush();

            return $this->redirectToRoute('manager_cabinet_groups_list');
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
        $em   = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $form = $this->createForm('event_groups');
        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var EventForm $eventForm */
            $eventForm = $form->getData();

            $event = (new Event())
                ->setName($eventForm->getName())
                ->setDescription($eventForm->getDescription())
                ->setCountry($eventForm->getCountry())
                ->setCity($eventForm->getCity())
                ->setAddress($eventForm->getAddress())
                ->setBeginAt($eventForm->getBeginAt())
                ->setEndAt($eventForm->getEndAt())
                ->setSlug($eventForm->getName())
                ->setCreatedBy($user)
                ->setUpdatedBy($user);

            $em->persist($event);

            /** @var Group $groupElement */
            foreach ($eventForm->getGroups() as $groupElement) {
                $group = $em->getRepository('AppBundle:Group')->findOneBy([
                    'slug' => $groupElement->getSlug(),
                ]);

                $eventGroups = (new EventGroup())
                    ->setEvent($event)
                    ->setGroup($group);

                $em->persist($eventGroups);
            }

            $em->flush();

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
        $em   = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $groupRepository = $em->getRepository('AppBundle:Group');

        $groups = $groupRepository->findGroupsByEvent($event);

        $eventForm = (new EventForm())
            ->setName($event->getName())
            ->setDescription($event->getDescription())
            ->setCountry($event->getCountry())
            ->setCity($event->getCity())
            ->setAddress($event->getAddress())
            ->setBeginAt($event->getBeginAt())
            ->setEndAt($event->getEndAt())
            ->setGroups($groups);

        $form = $this->createForm('event_groups', $eventForm);
        $form->handleRequest($request);
        if ($form->isValid()) {
            /** @var EventForm $eventForm */
            $eventFormData = $form->getData();

            /** @var Event $event */
            $event
                ->setName($eventFormData->getName())
                ->setDescription($eventFormData->getDescription())
                ->setCountry($eventFormData->getCountry())
                ->setCity($eventFormData->getCity())
                ->setAddress($eventFormData->getAddress())
                ->setBeginAt($eventFormData->getBeginAt())
                ->setEndAt($eventFormData->getEndAt())
                ->setSlug($eventFormData->getName())
                ->setCreatedBy($event->getCreatedBy())
                ->setUpdatedBy($user);

            $em->persist($event);

            $groups = $groupRepository->findGroupsByEvent($event);

            /** @var Group $groupElement */
            foreach ($eventForm->getGroups() as $groupElement) {
                $group = $groupRepository->findOneBy([
                    'slug' => $groupElement->getSlug(),
                ]);

                if (!in_array($group, $groups)) {
                    $eventGroups = (new EventGroup())
                        ->setEvent($event)
                        ->setGroup($group);

                    $em->persist($eventGroups);
                }
            }
            $em->flush();

            return $this->redirectToRoute('manager_cabinet_events_list');
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
