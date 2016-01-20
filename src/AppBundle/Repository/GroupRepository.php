<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Genre;
use AppBundle\Entity\Group;
use Doctrine\ORM\EntityRepository;

/**
 * Class GroupRepository
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GroupRepository extends EntityRepository
{
    /**
     * Get genres for group
     *
     * @param Group $group Group
     *
     * @return array
     */
    public function getGenres(Group $group)
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->select('ge.id')
                  ->addSelect('ge.name')
                  ->addSelect('ge.slug')
                  ->join('g.groupGenres', 'gg')
                  ->join('gg.genre', 'ge')
                  ->where($qb->expr()->eq('g', ':group'))
                  ->setParameter('group', $group)
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Get all groups by genre
     *
     * @param Genre $genre Genre
     *
     * @return array
     */
    public function getGroupsByGenre(Genre $genre)
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->select('g')
                  ->where($qb->expr()->eq('gg.genre', ':genre'))
                  ->join('g.groupGenres', 'gg')
                  ->setParameter('genre', $genre)
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Get all events by group
     *
     * @param Group $event Group
     *
     * @return array
     */
    public function getEventsByGroup(Group $group)
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->select('e.id')
                  ->addSelect('e.name')
                  ->addSelect('e.description')
                  ->addSelect('e.address')
                  ->addSelect('e.country')
                  ->addSelect('e.city')
                  ->addSelect('e.beginAt')
                  ->addSelect('e.endAt')
                  ->addSelect('e.duration')
                  ->addSelect('e.slug')
                  ->where($qb->expr()->eq('g', ':group'))
                  ->andWhere($qb->expr()->gt('e.beginAt', ':date_time_now'))
                  ->join('g.eventGroups', 'eg')
                  ->join('eg.event', 'e')
                  ->setParameter('group', $group)
                  ->setParameter('date_time_now', new \DateTime('now'), \Doctrine\DBAL\Types\Type::DATETIME)
                  ->getQuery()
                  ->getResult();
    }
}