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

    /**
     * Find Albums by group
     *
     * @param string $urlApiService Url Api of service
     * @param string $apiKey        Api key
     * @param Group  $group         Group
     *
     * @return []
     */
    public function findAlbumsByGroup($urlApiService, $apiKey, $group)
    {
        $albums = [];

        $client   = new Client();
        $response = json_decode($client->get($urlApiService, [
            'query' => [
                'method'  => 'artist.gettopalbums',
                'artist'  => $group->getName(),
                'api_key' => $apiKey,
                'limit'   => 10,
                'format'  => 'json',
            ],
        ])->getBody()->getContents());

        if (!array_key_exists('error', get_object_vars($response))) {
            foreach ($response->topalbums->album as $album) {
                if ('(null)' !== $album->name && "" !== $album->image[0]->{'#text'}) {
                    $albums[] = $album;
                }
            }
        }

        return $albums;
    }
}
