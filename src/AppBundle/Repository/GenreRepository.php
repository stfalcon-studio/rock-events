<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Genre;
use AppBundle\Entity\Group;
use AppBundle\Entity\User;
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

    /**
     * Find Genres by user
     *
     * @param User $user
     *
     * @return Genre[]
     */
    public function findGenresByUser(User $user)
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->where($qb->expr()->eq('u', ':user'))
                  ->join('g.userGenres', 'ug')
                  ->join('ug.user', 'u')
                  ->setParameter('user', $user)
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find Genres with count group
     *
     * @return Genre[]
     */
    public function findGenresWithCountGroup()
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->addSelect('COUNT(gg.genre) as group_count')
                  ->leftJoin('g.groupGenres', 'gg')
                  ->groupBy('gg.genre')
                  ->orderBy('group_count', 'DESC')
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find count likes by genre
     *
     * @param Genre $genre Genre
     *
     * @return int
     */
    public function findCountLikesByGenre(Genre $genre)
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->select('COUNT(ug.genre) as likes')
                  ->where($qb->expr()->eq('g', ':genre'))
                  ->leftJoin('g.userGenres', 'ug')
                  ->setParameter('genre', $genre)
                  ->getQuery()
                  ->getResult();
    }
}
