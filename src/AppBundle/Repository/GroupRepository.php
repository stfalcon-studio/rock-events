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

    /**
     * Find Groups with count likes
     *
     * @return Group[]
     */
    public function findGroupsWithCountLike()
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->addSelect('COUNT(ug.group) as likes')
                  ->leftJoin('g.userGroups', 'ug')
                  ->groupBy('g.id')
                  ->addGroupBy('ug.group')
                  ->orderBy('likes', 'DESC')
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find count likes by group
     *
     * @param Group $group Group
     *
     * @return int
     */
    public function findCountLikesByGroup(Group $group)
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->select('COUNT(ug.group) as likes')
                  ->where($qb->expr()->eq('g', ':group'))
                  ->leftJoin('g.userGroups', 'ug')
                  ->setParameter('group', $group)
                  ->getQuery()
                  ->getOneOrNullResult();
    }

    /**
     * Find groups by genre with count likes
     *
     * @param Genre $genre Genre
     *
     * @return array
     */
    public function findGroupsByGenreWithCountLikes(Genre $genre)
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->addSelect('COUNT(ug.group) as likes')
                  ->where($qb->expr()->eq('ge', ':genre'))
                  ->leftJoin('g.userGroups', 'ug')
                  ->join('g.groupGenres', 'gg')
                  ->join('gg.genre', 'ge')
                  ->groupBy('gg.id')
                  ->orderBy('likes', 'DESC')
                  ->setParameter('genre', $genre)
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find Check by user and group
     *
     * @param User  $user  User
     * @param Group $group Group
     *
     * @return Group[]
     */
    public function findCheckByUserAndGroup(User $user, Group $group)
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->where($qb->expr()->eq('u', ':user'))
                  ->andWhere($qb->expr()->eq('g', ':group'))
                  ->join('g.userGroups', 'ug')
                  ->join('ug.user', 'u')
                  ->setParameters([
                      'user'  => $user,
                      'group' => $group,
                  ])
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find similar groups by genres
     *
     * @param Genre[] $genres Array of Genre
     *
     * @return Group[]
     */
    public function findGroupsByGenres(array $genres, $limit = 6, $offset = 0)
    {
        $qb = $this->createQueryBuilder('g');

        $qb->join('g.groupGenres', 'gg')
           ->join('gg.genre', 'ge');

        foreach ($genres as $item => $genre) {
            if (0 === $item) {
                $qb->where($qb->expr()->eq('ge', ':genre'))
                   ->setParameter('genre', $genre);
            } else {
                $qb->orWhere($qb->expr()->eq('ge', ':genre'))
                   ->setParameter('genre', $genre);
            }
        }

        return $qb->setFirstResult($offset)
                  ->setMaxResults($limit)
                  ->getQuery()
                  ->getResult();
    }
}
