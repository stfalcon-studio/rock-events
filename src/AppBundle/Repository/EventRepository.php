<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Event;
use AppBundle\Entity\Group;
use AppBundle\Entity\User;
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

    /**
     * Find event by group and genre
     *
     * @param User $user User
     *
     * @return Event[]
     */
    public function findEventsByUserBookMark(User $user)
    {
        $sql            = '(SELECT DISTINCT e.*
                            FROM events as e
                            INNER JOIN events_to_groups as eg
                            ON e.id = eg.group_id
                            INNER JOIN users_to_groups as ug
                            ON eg.id=ug.group_id
                            WHERE ug.user_id = :user)
                            UNION
                            (SELECT DISTINCT e.*
                            FROM events as e
                            INNER JOIN events_to_groups as eg
                            ON e.id = eg.event_id
                            INNER JOIN groups as gr
                            ON gr.id = eg.group_id
                            INNER JOIN groups_to_genres as gr_ge
                            ON gr.id = gr_ge.group_id
                            INNER JOIN genres as ge
                            ON ge.id = gr_ge.genre_id
                            INNER JOIN users_to_genres as us_ge
                            ON ge.id = us_ge.genre_id
                            WHERE us_ge.user_id = :user)';
        $params['user'] = $user->getId();
        $stmt           = $this->getEntityManager()
                               ->getConnection()
                               ->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    /**
     * Find events by manager
     *
     * @param User $user   User
     * @param int  $limit  Limit
     * @param int  $offset Offset
     *
     * @return Event[]
     */
    public function findEventsByManager(User $user, $limit = 10, $offset = 0)
    {
        $qb = $this->createQueryBuilder('e');

        $qb->where($qb->expr()->eq('m', ':user'))
           ->andWhere($qb->expr()->gt('e.beginAt', '\''.(new \DateTime())->format('Y-m-d H:i:s').'\''))
           ->join('e.eventGroups', 'eg')
           ->join('eg.group', 'g')
           ->join('g.managerGroups', 'mg')
           ->join('mg.manager', 'm')
           ->setParameter('user', $user)
           ->orderBy('e.beginAt', 'ASC')
           ->setFirstResult($offset)
           ->setMaxResults($limit)
           ->getQuery()
           ->getResult();
    }

    /**
     * Find previous events by manager
     *
     * @param User $user
     *
     * @return Event[]
     */
    public function findPreviousEventsByManager(User $user)
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->where($qb->expr()->eq('m', ':user'))
                  ->andWhere($qb->expr()->lt('e.beginAt', '\''.(new \DateTime())->format('Y-m-d H:i:s').'\''))
                  ->join('e.eventGroups', 'eg')
                  ->join('eg.group', 'g')
                  ->join('g.managerGroups', 'mg')
                  ->join('mg.manager', 'm')
                  ->setParameter('user', $user)
                  ->orderBy('e.beginAt', 'DESC')
                  ->getQuery()
                  ->getResult();
    }
}
