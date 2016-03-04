<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Event;
use AppBundle\Entity\Genre;
use AppBundle\Entity\Group;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use PDO;

/**
 * Class EventRepository
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class EventRepository extends EntityRepository
{
    /**
     * Find actual events
     *
     * @param int $limit  Limit
     * @param int $offset Offset
     *
     * @return Event[]
     */
    public function findActualEvents($limit = 10, $offset = 0)
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->where($qb->expr()->gt('e.beginAt', ':now'))
                  ->andWhere($qb->expr()->eq('e.isActive', true))
                  ->setParameter('now', (new \DateTime())->format('Y-m-d H:i:s'))
                  ->setFirstResult($offset)
                  ->setMaxResults($limit)
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find events for the week
     *
     * @param int $limit Limit
     *
     * @return Event[]
     */
    public function findEventsForWeek($limit = 5)
    {
        $qb = $this->createQueryBuilder('e');

        $dateCondition = 'DATE(e.beginAt)-DATE(:now)';

        return $qb->where($qb->expr()->gt(7, $dateCondition))
                  ->andWhere($qb->expr()->eq('e.isActive', true))
                  ->setParameter('now', (new \DateTime())->format('Y-m-d H:i:s'))
                  ->setMaxResults($limit)
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find events by group
     *
     * @param Group $group Group
     *
     * @return Event[]
     */
    public function findEventsByGroup(Group $group)
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->where($qb->expr()->eq('g', ':group'))
                  ->andWhere($qb->expr()->eq('e.isActive', true))
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
                            ON e.id = eg.event_id
                            INNER JOIN users_to_groups as ug
                            ON eg.group_id = ug.group_id
                            WHERE ug.user_id = :user AND e.begin_at > now())
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
                            WHERE us_ge.user_id = :user AND e.begin_at > now())';
        $params['user'] = $user->getId();

        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'AppBundle\Entity\Event');
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

        return $qb->where($qb->expr()->eq('m', ':user'))
                  ->andWhere($qb->expr()->gt('e.beginAt', ':now'))
                  ->andWhere($qb->expr()->eq('e.isActive', true))
                  ->join('e.eventGroups', 'eg')
                  ->join('eg.group', 'g')
                  ->join('g.managerGroups', 'mg')
                  ->join('mg.manager', 'm')
                  ->setParameters([
                      'user' => $user,
                      'now'  => (new \DateTime())->format('Y-m-d H:i:s'),
                  ])
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
                  ->andWhere($qb->expr()->lt('e.beginAt', ':now'))
                  ->andWhere($qb->expr()->eq('e.isActive', true))
                  ->join('e.eventGroups', 'eg')
                  ->join('eg.group', 'g')
                  ->join('g.managerGroups', 'mg')
                  ->join('mg.manager', 'm')
                  ->setParameters([
                      'user' => $user,
                      'now'  => (new \DateTime())->format('Y-m-d H:i:s'),
                  ])
                  ->orderBy('e.beginAt', 'DESC')
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find events by similar genres
     *
     * @param Genre[] $genres
     *
     * @return Event[]
     */
    public function findEventsBySimilarGenres(array $genres)
    {
        $qb = $this->createQueryBuilder('e');

        $events = $qb->join('e.eventGroups', 'eg')
                     ->join('eg.group', 'gr')
                     ->join('gr.groupGenres', 'gg')
                     ->join('gg.genre', 'ge');

        foreach ($genres as $item => $genre) {
            if (0 === $item) {
                $events->where($qb->expr()->eq('ge', ':genre'))
                       ->setParameter('genre', $genre);
            } else {
                $events->orWhere($qb->expr()->eq('ge', ':genre'))
                       ->setParameter('genre', $genre);
            }
        }
        $qb->andWhere($qb->expr()->gt('e.beginAt', ':now'))
           ->andWhere($qb->expr()->eq('e.isActive', true))
           ->setParameter('now', (new \DateTime())->format('Y-m-d H:i:s'));

        return $events->getQuery()
                      ->getResult();
    }

    /**
     * @param int $limit  Limit
     * @param int $offset Offset
     *
     * @return Event[]
     */
    public function findPreviousEvents($limit = 5, $offset = 0)
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->where($qb->expr()->lt('e.beginAt', ':now'))
                  ->andWhere($qb->expr()->eq('e.isActive', true))
                  ->orderBy('e.beginAt', 'ASC')
                  ->setParameter('now', (new \DateTime())->format('Y-m-d H:i:s'))
                  ->setFirstResult($offset)
                  ->setMaxResults($limit)
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find actual events by group
     *
     * @param Group $group Group
     *
     * @return Event[]
     */
    public function findActualEventsByGroup(Group $group)
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->where($qb->expr()->eq('g', ':group'))
                  ->andWhere($qb->expr()->gt('e.beginAt', ':now'))
                  ->andWhere($qb->expr()->eq('e.isActive', true))
                  ->join('e.eventGroups', 'eg')
                  ->join('eg.group', 'g')
                  ->setParameters([
                      'group' => $group,
                      'now'   => (new \DateTime())->format('Y-m-d H:i:s'),
                  ])
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find all city by events
     *
     * @return Event[]
     */
    public function findAllCityByEvents()
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->select('e.id, e.city as name, COUNT(e.city) as count_city')
                  ->where($qb->expr()->gt('e.beginAt', ':now'))
                  ->andWhere($qb->expr()->eq('e.isActive', true))
                  ->groupBy('e.city')
                  ->orderBy('count_city', 'DESC')
                  ->setParameter('now', (new \DateTime())->format('Y-m-d H:i:s'))
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find events by filter
     *
     * @param null|Genre  $genre
     * @param null|string $city
     * @param null|string $date
     *
     * @return array
     */
    public function findEventsByFilter($genre = null, $city = null, $date = null)
    {
        $qb = $this->createQueryBuilder('e');

        $parameters = [
            'now' => (new \DateTime())->format('Y-m-d H:i:s'),
        ];

        $qb->where($qb->expr()->gt('e.beginAt', ':now'))
           ->andWhere($qb->expr()->eq('e.isActive', true))
           ->join('e.eventGroups', 'eg')
           ->join('eg.group', 'gr')
           ->join('gr.groupGenres', 'gg')
           ->join('gg.genre', 'ge');

        if (!empty($genre)) {
            $qb->andWhere($qb->expr()->eq('ge', ':genre'));
            $parameters['genre'] = $genre;
        }

        if (!empty($city)) {
            $qb->andWhere($qb->expr()->eq('e.city', ':city'));
            $parameters['city'] = $city;
        }

        if (!empty($date)) {
            $differenceBetweenDates = 'DATE(e.beginAt)-DATE(:now)';

            switch ($date) {
                case 'today':
                    $qb->andWhere($qb->expr()->gte(1, $differenceBetweenDates));
                    break;
                case 'week':
                    $qb->andWhere($qb->expr()->gte(7, $differenceBetweenDates));
                    break;
                case 'month':
                    $qb->andWhere($qb->expr()->gte(31, $differenceBetweenDates));
                    break;
                case 'year':
                    $qb->andWhere($qb->expr()->gte(360, $differenceBetweenDates));
                    break;
            }
        }

        return $qb->setParameters($parameters)
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find all actual by genres and groups with limit
     *
     * @param Genre[] $genres Genres
     * @param Group[] $groups Groups
     * @param int     $limit  Limit
     *
     * @return array Active events
     */
    public function findAllActiveByGenresAndGroupsWithLimit($genres, $groups, $limit = 5)
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->where($qb->expr()->in('ge', ':genres'))
                  ->orWhere($qb->expr()->in('gr', ':groups'))
                  ->andWhere($qb->expr()->gt('e.beginAt', ':now'))
                  ->andWhere($qb->expr()->eq('e.isActive', true))
                  ->join('e.eventGroups', 'eg')
                  ->join('eg.group', 'gr')
                  ->join('gr.groupGenres', 'gg')
                  ->join('gg.genre', 'ge')
                  ->setParameters([
                      'genres' => $genres,
                      'groups' => $groups,
                      'now'    => (new \DateTime())->format('Y-m-d H:i:s'),
                  ])
                  ->distinct('e')
                  ->setMaxResults(5)
                  ->getQuery()
                  ->getResult();
    }
}
