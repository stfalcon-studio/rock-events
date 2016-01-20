<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Genre;
use Doctrine\ORM\EntityRepository;

/**
 * Class GenreRepository
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GenreRepository extends EntityRepository
{
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

        return $qb->select('gr.id')
                  ->addSelect('gr.name')
                  ->addSelect('gr.description')
                  ->addSelect('gr.foundedAt')
                  ->addSelect('gr.slug')
                  ->where($qb->expr()->eq('g', ':genre'))
                  ->join('g.groupGenres', 'gg')
                  ->join('gg.group', 'gr')
                  ->setParameter('genre', $genre)
                  ->getQuery()
                  ->getResult();
    }
}