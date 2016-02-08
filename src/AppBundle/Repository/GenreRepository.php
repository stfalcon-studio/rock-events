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

        return $qb->addSelect('COUNT(ug.genre) as genre_likes')
                  ->leftJoin('g.userGenres', 'ug')
                  ->groupBy('g.id')
                  ->orderBy('genre_likes', 'DESC')
                  ->getQuery()
                  ->getResult();
    }

    /**
     * Find count groups by genre
     *
     * @param Genre $genre Genre
     *
     * @return int
     */
    public function findCountGroupsByGenre(Genre $genre)
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->select('COUNT(gg.genre) as count_groups')
                  ->where($qb->expr()->eq('g', ':genre'))
                  ->leftJoin('g.groupGenres', 'gg')
                  ->setParameter('genre', $genre)
                  ->getQuery()
                  ->getResult();
    }
}
