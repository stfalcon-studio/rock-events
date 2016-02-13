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
 * @author Oleg Kachinsky <logansoleg@gmail.com>
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
                  ->andWhere($qb->expr()->eq('g.isActive', true))
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
                  ->andWhere($qb->expr()->eq('g.isActive', true))
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
                  ->andWhere($qb->expr()->eq('g.isActive', true))
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
                  ->andWhere($qb->expr()->eq('g.isActive', true))
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
                  ->andWhere($qb->expr()->eq('g.isActive', true))
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
                  ->andWhere($qb->expr()->eq('g.isActive', true))
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
                  ->andWhere($qb->expr()->eq('g.isActive', true))
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
                  ->andWhere($qb->expr()->eq('g.isActive', true))
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
     * @param int     $limit  Limit
     * @param int     $offset Offset
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

        return $qb->andWhere($qb->expr()->eq('g.isActive', true))
                  ->setFirstResult($offset)
                  ->setMaxResults($limit)
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find all countries by groups
     *
     * @return Group[]
     */
    public function findAllCountriesByGroups()
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->select('g.id, g.country as name, COUNT(g.country) as count_country')
                  ->where($qb->expr()->eq('g.isActive', true))
                  ->groupBy('g.country')
                  ->orderBy('count_country', 'DESC')
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find all cities by groups
     *
     * @return Group[]
     */
    public function findAllCitiesByGroups()
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->select('g.id, g.city as name, COUNT(g.city) as count_city')
                  ->where($qb->expr()->eq('g.isActive', true))
                  ->groupBy('g.city')
                  ->orderBy('count_city', 'DESC')
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find groups by filter
     *
     * @param null|Genre  $genre
     * @param null|string $country
     * @param null|string $city
     * @param null|string $like
     *
     * @return array
     */
    public function findGroupsByFilter($genre = null, $country = null, $city = null, $like = null)
    {
        $qb = $this->createQueryBuilder('g');

        $parameters = [];

        $qb->addSelect('COUNT(ug.group) as likes')
           ->join('g.groupGenres', 'gg')
           ->join('gg.genre', 'ge')
           ->leftJoin('g.userGroups', 'ug')
           ->groupBy('gg.id');

        //Flag for check where
        $flag = false;

        if (!empty($genre)) {
            $qb->where($qb->expr()->eq('ge', ':genre'));
            $parameters['genre'] = $genre;

            $flag = true;
        }

        if (!empty($country)) {
            if (false === $flag) {
                $qb->where($qb->expr()->eq('g.country', ':country'));
                $flag = true;
            } else {
                $qb->andWhere($qb->expr()->eq('g.country', ':country'));
            }
            $parameters['country'] = $country;
        }

        if (!empty($city)) {
            if (false === $flag) {
                $qb->where($qb->expr()->eq('g.city', ':city'));
                $flag = true;
            } else {
                $qb->andWhere($qb->expr()->eq('g.city', ':city'));
            }
            $parameters['city'] = $city;
        }

        if (!empty($like)) {
            $qb->orderBy('likes', $like);
        }

        return $qb->andWhere($qb->expr()->eq('g.isActive', true))
                  ->setParameters($parameters)
                  ->getQuery()
                  ->getResult();
    }
}
