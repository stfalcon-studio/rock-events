<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Event;
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
     * @param Event $event
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
}