<?php

namespace AppBundle\Service;

use AppBundle\Entity\Group;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;

/**
 * GroupService
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GroupService
{
    /**
     * @var EntityManager $entityManager Entity manager
     */
    private $entityManager;

    /**
     * Constructor
     *
     * @param EntityManager $em Entity manager
     */
    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    /**
     * Find events by filter from request
     *
     * @param Request $request Request
     *
     * @return []
     */
    public function findGroupsByFilter(Request $request)
    {
        $genre   = $request->query->get('genre');
        $country = $request->query->get('country');
        $city    = $request->query->get('city');
        $like    = $request->query->get('like');

        return $this->entityManager->getRepository('AppBundle:Group')
                                   ->findGroupsByFilter($genre, $country, $city, $like);
    }
}
