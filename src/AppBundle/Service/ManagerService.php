<?php

namespace AppBundle\Service;

use AppBundle\Entity\EventGroup;
use AppBundle\Entity\ManagerGroup;
use AppBundle\Entity\User;
use AppBundle\Form\Entity\Group as GroupForm;
use AppBundle\Entity\Group;
use AppBundle\Entity\Event;
use AppBundle\Form\Entity\Event as EventForm;
use Doctrine\ORM\EntityManager;

/**
 * ManagerService class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class ManagerService
{
    /**
     * @var EntityManager $entityManager Entity manager
     */
    private $entityManager;

    /**
     * Constructor
     *
     * @param EntityManager $em Entity manager
     */
    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    /**
     * Save group to db
     *
     * @param GroupForm $groupForm GroupForm
     * @param User      $user      User
     */
    public function saveGroupOnCreate(GroupForm $groupForm, User $user)
    {
        $group = (new Group())
            ->setName($groupForm->getName())
            ->setDescription($groupForm->getDescription())
            ->setCountry($groupForm->getCountry())
            ->setCity($groupForm->getCity())
            ->setSlug($groupForm->getName())
            ->setImageName($groupForm->getImageName())
            ->setFoundedAt($groupForm->getFoundedAt())
            ->setCreatedBy($user)
            ->setUpdatedBy($user);

        $managerGroup = (new ManagerGroup())
            ->setGroup($group)
            ->setManager($user);

        $this->entityManager->persist($group);
        $this->entityManager->persist($managerGroup);

        $this->entityManager->flush();
    }

    /**
     * Update group from db
     *
     * @param GroupForm $groupForm
     * @param Group     $group
     * @param User      $user
     */
    public function saveGroupOnUpdate(GroupForm $groupForm, Group $group, User $user)
    {
        $group->setName($groupForm->getName())
              ->setDescription($groupForm->getDescription())
              ->setCountry($groupForm->getCountry())
              ->setCity($groupForm->getCity())
              ->setSlug($groupForm->getName())
              ->setFoundedAt($groupForm->getFoundedAt())
              ->setUpdatedBy($user);

        $managerGroup = $this->entityManager->getRepository('AppBundle:ManagerGroup')->findOneBy([
            'group' => $group,
        ]);
        $managerGroup->setGroup($group);

        $this->entityManager->persist($group);
        $this->entityManager->persist($managerGroup);

        $this->entityManager->flush();
    }

    /**
     * Convert object AppBundle\Entity\Group to AppBundle\Form\Entity\Group
     *
     * @param Group $group Group
     *
     * @return GroupForm[]
     */
    public function convertToGroupForm(Group $group)
    {
        return (new GroupForm())
            ->setName($group->getName())
            ->setDescription($group->getDescription())
            ->setCountry($group->getCountry())
            ->setCity($group->getCity())
            ->setFoundedAt($group->getFoundedAt()->format('Y'));
    }

    /**
     * Save event to db
     *
     * @param EventForm $eventForm
     * @param User      $user
     */
    public function saveEventOnCreate(EventForm $eventForm, User $user)
    {
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

        $this->entityManager->persist($event);

        /** @var Group $groupElement */
        foreach ($eventForm->getGroups() as $groupElement) {
            $group = $this->entityManager->getRepository('AppBundle:Group')->findOneBy([
                'slug' => $groupElement->getSlug(),
            ]);

            $eventGroups = (new EventGroup())
                ->setEvent($event)
                ->setGroup($group);

            $this->entityManager->persist($eventGroups);
        }

        $this->entityManager->flush();
    }

    /**
     * Update event from db
     *
     * @param EventForm $eventForm
     * @param Event     $event
     * @param User      $user
     */
    public function saveEventOnUpdate(EventForm $eventForm, Event $event, User $user)
    {
        $groupRepository = $this->entityManager->getRepository('AppBundle:Group');

        /** @var Event $event */
        $event
            ->setName($eventForm->getName())
            ->setDescription($eventForm->getDescription())
            ->setCountry($eventForm->getCountry())
            ->setCity($eventForm->getCity())
            ->setAddress($eventForm->getAddress())
            ->setBeginAt($eventForm->getBeginAt())
            ->setEndAt($eventForm->getEndAt())
            ->setSlug($eventForm->getName())
            ->setUpdatedBy($user);

        $this->entityManager->persist($event);

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

                $this->entityManager->persist($eventGroups);
            }
        }

        $this->entityManager->flush();
    }

    /**
     * Convert object AppBundle\Entity\Event to AppBundle\Form\Entity\Event
     *
     * @param Event $event Event
     *
     * @return EventForm[]
     */
    public function convertToEventForm(Event $event)
    {
        $groups = $this->entityManager->getRepository('AppBundle:Group')->findGroupsByEvent($event);

        return (new EventForm())
            ->setName($event->getName())
            ->setDescription($event->getDescription())
            ->setCountry($event->getCountry())
            ->setCity($event->getCity())
            ->setAddress($event->getAddress())
            ->setBeginAt($event->getBeginAt())
            ->setEndAt($event->getEndAt())
            ->setGroups($groups);
    }
}
