<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class GroupGenreRepository
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GroupGenreRepository extends EntityRepository
{
    /**
     * Get all groups for genre
     *
     * @param int $genre Genre
     *
     * @return array
     */
    public function getGroupsForGenre($genre)
    {
        $qb = $this->createQueryBuilder('gg');

        $qb->select('gg.id')
            ->addSelect('gr.name')
            ->addSelect('gr.description')
            ->addSelect('gr.foundedAt')
            ->addSelect('ge.name' . ' AS nameGenre')
            ->join('gg.group', 'gr')
            ->join('gg.genre', 'ge')
            ->where($qb->expr()->eq('ge.id', ':genre'))
            ->setParameter('genre', $genre);

        return $qb->getQuery()->getArrayResult();
    }
}