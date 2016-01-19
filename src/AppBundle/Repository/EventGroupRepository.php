<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class EventGroupRepository
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class EventGroupRepository extends EntityRepository
{
    /**
    * Get all actual events
    *
    * @return array
    */
    public function getAllActualEventGroup()
    {
        $qb = $this->createQueryBuilder('eg');

        $qb->select('eg.id')
            ->addSelect('e.name'.' AS nameEvent')
            ->addSelect('g.name'.' AS nameGroup')
            ->addSelect('e.city')
            ->addSelect('e.beginAt')
            ->join('eg.event', 'e')
            ->join('eg.group', 'g')
            ->where($qb->expr()->gt('e.beginAt', ':dateTimeNow'))
            ->orderBy('e.beginAt', 'ASC')
            ->setParameter('dateTimeNow', new \DateTime('now'), \Doctrine\DBAL\Types\Type::DATETIME);

        return $qb->getQuery()->getArrayResult();
    }

    /**
     * Get all groups for event
     *
     * @param int $event Event
     *
     * @return array
     */
    public function getGroupsForEvent($event)
    {
        $qb = $this->createQueryBuilder('eg');

        $qb->select('g.id')
            ->addSelect('g.name')
            ->addSelect('g.description')
            ->addSelect('g.foundedAt')
            ->addSelect('e.name'.' AS nameEvent')
            ->join('eg.event', 'e')
            ->join('eg.group', 'g')
            ->where($qb->expr()->eq('e.id', ':event'))
            ->andWhere($qb->expr()->gt('e.beginAt', ':dateTimeNow'))
            ->setParameter('event', $event)
            ->setParameter('dateTimeNow', new \DateTime('now'), \Doctrine\DBAL\Types\Type::DATETIME);

        return $qb->getQuery()->getArrayResult();
    }

    /**
     * Get all events for group
     *
     * @param int $group Group
     *
     * @return array
     */
    public function getEventsForGroup($group)
    {
        $qb = $this->createQueryBuilder('eg');

        $qb->select('e.id')
            ->addSelect('e.name')
            ->addSelect('e.description')
            ->addSelect('e.city')
            ->addSelect('e.beginAt')
            ->addSelect('g.name'.' AS nameGroup')
            ->join('eg.event', 'e')
            ->join('eg.group', 'g')
            ->where($qb->expr()->eq('g.id', ':group'))
            ->andWhere($qb->expr()->gt('e.beginAt', ':dateTimeNow'))
            ->setParameter('group', $group)
            ->setParameter('dateTimeNow', new \DateTime('now'), \Doctrine\DBAL\Types\Type::DATETIME);

        return $qb->getQuery()->getArrayResult();
    }
}