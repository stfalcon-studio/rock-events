<?php

namespace AppBundle\Service;

use AppBundle\Entity\Group;
use GuzzleHttp\Client;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * GroupApiService class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GroupApiService
{
    /** @var Client $client Client */
    private $client;

    /** @var string $lastFmApiUrl LastFm Api url */
    private $lastFmApiUrl;

    /** @var string $lastFmKey LastFm key */
    private $lastFmKey;

    /**
     * Constructor
     *
     * @param string $lastFmApiUrl LastFm Api url
     * @param string $lastFmKey    LastFm key
     */
    public function __construct($lastFmApiUrl, $lastFmKey)
    {
        $this->client       = new Client();
        $this->lastFmApiUrl = $lastFmApiUrl;
        $this->lastFmKey    = $lastFmKey;
    }

    /**
     * Find Albums by group
     *
     * @param Group $group Group
     *
     * @return []
     */
    public function findAlbumsByGroup($group)
    {
        $albums = [];

        $response = $this->client->get($this->lastFmApiUrl, [
            'query' => [
                'method'  => 'artist.gettopalbums',
                'artist'  => $group->getName(),
                'api_key' => $this->lastFmKey,
                'limit'   => 10,
                'format'  => 'json',
            ],
        ]);

        $data = json_decode((string) $response->getBody()->getContents());

        if (!array_key_exists('error', get_object_vars($data))) {
            foreach ($data->topalbums->album as $album) {
                if ('(null)' !== $album->name && "" !== $album->image[0]->{'#text'}) {
                    $albums[] = $album;
                }
            }
        }

        return $albums;
    }

    /**
     * Find Album group
     *
     * @param Group  $group Group
     * @param string $album Album
     *
     * @throws BadRequestHttpException
     *
     * @return []
     */
    public function findAlbumGroup($group, $album)
    {
        $response = $this->client->get($this->lastFmApiUrl, [
            'query' => [
                'method'  => 'album.getinfo',
                'artist'  => $group->getName(),
                'album'   => $album,
                'api_key' => $this->lastFmKey,
                'format'  => 'json',
            ],
        ]);

        $data = json_decode((string) $response->getBody()->getContents());

        if (array_key_exists('error', get_object_vars($data))) {
            throw new BadRequestHttpException('Не правильний запит');
        }

        $durationMinutes = 0;
        $album           = $data->album;

        if (!property_exists($album, 'wiki')) {
            $album->wiki            = new \stdClass();
            $album->wiki->published = 'Не відомо';
        }

        foreach ($album->tracks->track as $track) {
            $durationMinutes += $track->duration;
        }

        $album->duration  = [
            'hour'   => round($durationMinutes / 60),
            'minute' => $durationMinutes % 60,
        ];
        $album->groupSlug = $group->getSlug();

        return $album;
    }
}
