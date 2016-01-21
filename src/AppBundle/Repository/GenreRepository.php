<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Genre;
use AppBundle\Entity\Group;
use Doctrine\ORM\EntityRepository;

/**
 * Class GenreRepository
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GenreRepository extends EntityRepository
{
    /**
     * Find Genres by group
     *
     * @param Group $group
     *
     * @return Genre[]
     */
    public function findGenresByGroup(Group $group)
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->where($qb->expr()->eq('gr', ':group'))
                  ->join('g.groupGenres', 'gg')
                  ->join('gg.group', 'gr')
                  ->setParameter('group', $group)
                  ->getQuery()
                  ->getResult();
    }
}