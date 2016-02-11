<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Event;
use AppBundle\Entity\Genre;
use AppBundle\Entity\Group;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use DoctrineExtensions\Query\Mysql\Date;
use PDO;

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
    public function findActualEvents($limit = 10, $offset = 0)
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->where($qb->expr()->gt('e.beginAt', '\''.(new \DateTime())->format('Y-m-d H:i:s').'\''))
                  ->setFirstResult($offset)
                  ->setMaxResults($limit)
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
        $qb->andWhere($qb->expr()->gt('e.beginAt', '\''.(new \DateTime())->format('Y-m-d H:i:s').'\''));

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

        return $qb->where($qb->expr()->lt('e.beginAt', '\''.(new \DateTime())->format('Y-m-d H:i:s').'\''))
                  ->orderBy('e.beginAt', 'ASC')
                  ->setFirstResult($offset)
                  ->setMaxResults($limit)
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find actual events by group
     *
     * @param Group $event Group
     *
     * @return Event[]
     */
    public function findActualEventsByGroup(Group $group)
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->where($qb->expr()->eq('g', ':group'))
                  ->andWhere($qb->expr()->gt('e.beginAt', '\''.(new \DateTime())->format('Y-m-d H:i:s').'\''))
                  ->join('e.eventGroups', 'eg')
                  ->join('eg.group', 'g')
                  ->setParameter('group', $group)
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
                  ->where($qb->expr()->gt('e.beginAt', '\''.(new \DateTime())->format('Y-m-d H:i:s').'\''))
                  ->groupBy('e.city')
                  ->orderBy('count_city', 'DESC')
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

        $parameters = [];

        $qb->where($qb->expr()->gt('e.beginAt', '\''.(new \DateTime())->format('Y-m-d H:i:s').'\''))
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
            $differenceBetweenDates = 'DATE(e.beginAt)-DATE('.'\''.(new \DateTime())->format('Y-m-d H:i:s').'\''.')';

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
}
