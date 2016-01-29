<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Event;
use AppBundle\Entity\Genre;
use AppBundle\Entity\Group;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

/**
 * Class GroupRepository
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GroupRepository extends EntityRepository
{
    /**
     * Find all groups by genre
     *
     * @param Genre $genre Genre
     *
     * @return Group[]
     */
    public function findGroupsByGenre(Genre $genre)
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->where($qb->expr()->eq('gg.genre', ':genre'))
                  ->join('g.groupGenres', 'gg')
                  ->setParameter('genre', $genre)
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find Groups by event
     *
     * @param Event $event Event
     *
     * @return Group[]
     */
    public function findGroupsByEvent(Event $event)
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->where($qb->expr()->eq('e', ':event'))
                  ->join('g.eventGroups', 'eg')
                  ->join('eg.event', 'e')
                  ->setParameter('event', $event)
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find Groups by user
     *
     * @param User $user User
     *
     * @return Group[]
     */
    public function findGroupsByUser(User $user)
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->where($qb->expr()->eq('u', ':user'))
                  ->join('g.userGroups', 'ug')
                  ->join('ug.user', 'u')
                  ->setParameter('user', $user)
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find Groups by manager
     *
     * @param User $user User
     *
     * @return Group[]
     */
    public function findGroupsByManager(User $user)
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->where($qb->expr()->eq('m', ':user'))
                  ->join('g.managerGroups', 'mg')
                  ->join('mg.manager', 'm')
                  ->setParameter('user', $user)
                  ->getQuery()
                  ->getResult();
    }
}
