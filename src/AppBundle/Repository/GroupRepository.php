<?php

namespace AppBundle\Repository;

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
     * @param int $group Group
     *
     * @return array
     */
    public function getGenres($group)
    {
        $qb = $this->createQueryBuilder('g');
        $qb->select('ge.id')
            ->addSelect('ge.name')
            ->join('g.groupGenres', 'gg')
            ->join('gg.genre', 'ge')
            ->where($qb->expr()->eq('g.id', ':group'))
            ->setParameter('group', $group);

        return $qb->getQuery()->getArrayResult();
    }
}