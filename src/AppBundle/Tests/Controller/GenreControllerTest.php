<?php

namespace AppBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\HttpFoundation\Response;

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
        $fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'AppBundle\DataFixtures\ORM\LoadGenreData',
            'AppBundle\DataFixtures\ORM\LoadGroupData',
            'AppBundle\DataFixtures\ORM\LoadGroupGenreData',
            'AppBundle\DataFixtures\ORM\LoadUserGenreData',
        ])->getReferenceRepository();

        $this->loginAs($fixtures->getReference('user-manager'), 'main');
        $this->client = static::makeClient();

        $crawler = $this->client->request('GET', '/genres');

        $this->assertStatusCode(Response::HTTP_OK, $this->client);
        $this->assertCount(1, $crawler->filter('ul.event-list'));
        $this->assertCount(6, $crawler->filter('li.event-list__item'));
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

        $this->assertStatusCode(Response::HTTP_OK, $this->client);
        $this->assertCount(1, $crawler->filter('div.l-filter-elements'));
        $this->assertCount(5, $crawler->filter('div.filtered-element'));
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

        $this->assertStatusCode(Response::HTTP_CREATED, $this->client);
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

        $this->assertStatusCode(Response::HTTP_OK, $this->client);
    }
}
