<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class EventRepository
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class EventRepository extends EntityRepository
{
    /**
     * Get groups for event
     *
     * @param int $event Event
     *
     * @return array
     */
    public function getGroups($event)
    {
        $qb = $this->createQueryBuilder('e');

        $qb->select('g.id')
            ->addSelect('g.name')
            ->addSelect('g.description')
            ->addSelect('g.foundedAt')
            ->join('e.eventGroups', 'eg')
            ->join('eg.group', 'g')
            ->where($qb->expr()->eq('e.id', ':event'))
            ->setParameter('event', $event);

        return $qb->getQuery()->getArrayResult();
    }
}