<?php

namespace AppBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

/**
 * GenreControllerTest class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GenreControllerTest extends WebTestCase
{
    /** @var Client $client */
    private $client;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->client = static::makeClient();
    }

    /**
     * Test list action
     */
    public function testListAction()
    {
        $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadGenreData',
        ]);

        $crawler = $this->client->request('GET', '/genres');

        $this->assertStatusCode(200, $this->client);
        $this->assertCount(1, $crawler->filter('table'));
        $this->assertCount(5, $crawler->filter('tr#genres'));
    }

    /**
     * Test group action
     */
    public function testGroupAction()
    {
        $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadGroupData',
            'AppBundle\DataFixtures\ORM\LoadGenreData',
            'AppBundle\DataFixtures\ORM\LoadGroupGenreData',
        ]);

        $crawler = $this->client->request('GET', 'genre/alternative/groups');

        $this->assertStatusCode(200, $this->client);
        $this->assertCount(1, $crawler->filter('table'));
        $this->assertCount(3, $crawler->filter('tr#groups'));
    }

    /**
     * Test AjaxAddToBookmark action
     */
    public function testAjaxAddToBookmarkAction()
    {
        $fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'AppBundle\DataFixtures\ORM\LoadUserGenreData',
            'AppBundle\DataFixtures\ORM\LoadGenreData',
        ])->getReferenceRepository();

        $this->loginAs($fixtures->getReference('user-admin'), 'main');

        $this->client = static::makeClient();

        $this->client->request('GET', '/genre/alternative/bookmark', [], [], [
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
        ]);

        $this->assertStatusCode(201, $this->client);
    }

    /**
     * Test AjaxDeleteFromBookmark action
     */
    public function testAjaxDeleteFromBookmarkAction()
    {
        $fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'AppBundle\DataFixtures\ORM\LoadUserGenreData',
            'AppBundle\DataFixtures\ORM\LoadGenreData',
        ])->getReferenceRepository();

        $this->loginAs($fixtures->getReference('user-admin'), 'main');

        $this->client = static::makeClient();

        $this->client->request('GET', '/genre/alternative/bookmark/delete', [], [], [
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
        ]);

        $this->assertStatusCode(200, $this->client);
    }
}
