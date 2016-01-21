<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Event;
use AppBundle\Entity\Group;
use Doctrine\ORM\EntityRepository;
use DoctrineExtensions\Query\Mysql\Date;

/**
 * Class EventRepository
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class EventRepository extends EntityRepository
{
    /**
     * Find actual events
     *
     * @return Event[]
     */
    public function findActualEvents()
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->where($qb->expr()->gt('e.beginAt', '\''.(new \DateTime())->format('Y-m-d H:i:s').'\''))
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find events for the week
     *
     * @return Event[]
     */
    public function findEventsForWeek()
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->where($qb->expr()->gt(7, ('DATE(e.beginAt)-DATE('.'\''.(new \DateTime())->format('Y-m-d H:i:s').'\''.')')))
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find events by group
     *
     * @param Group $event Group
     *
     * @return Event[]
     */
    public function findEventsByGroup(Group $group)
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->where($qb->expr()->eq('g', ':group'))
            ->join('e.eventGroups', 'eg')
            ->join('eg.group', 'g')
            ->setParameter('group', $group)
            ->getQuery()
            ->getResult();
    }
}