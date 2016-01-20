<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Event;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use DoctrineExtensions\Query\Mysql\Date;

/**
 * Class EventRepository
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class EventRepository extends EntityRepository
{
    /**
     * Get actual events
     *
     * @return array
     */
    public function getActualEvents()
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->select('e')
                  ->where($qb->expr()->gt('e.beginAt', ':date_time_now'))
                  ->setParameter('date_time_now', new \DateTime('now'), \Doctrine\DBAL\Types\Type::DATETIME)
                  ->getQuery()
                  ->getArrayResult();
    }

    /**
     * Get events for the week
     *
     * @return array
     */
    public function getEventsForWeek()
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->select('e')
                  ->where($qb->expr()->gt(7, (('DATE(e.beginAt)-DATE(:date_time_now)'))))
                  ->andWhere($qb->expr()->gt('e.beginAt', ':date_time_now'))
                  ->setParameter('date_time_now', new \DateTime('now'), \Doctrine\DBAL\Types\Type::DATETIME)
                  ->getQuery()
                  ->getArrayResult();
    }

    /**
     * Get groups for event
     *
     * @param Event $event Event
     *
     * @return array
     */
    public function getGroups(Event $event)
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->select('g.id')
                  ->addSelect('g.name')
                  ->addSelect('g.description')
                  ->addSelect('g.foundedAt')
                  ->addSelect('g.slug')
                  ->where($qb->expr()->eq('e', ':event'))
                  ->join('e.eventGroups', 'eg')
                  ->join('eg.group', 'g')
                  ->setParameter('event', $event)
                  ->getQuery()
                  ->getArrayResult();
    }
}