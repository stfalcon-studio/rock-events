<?php

namespace AppBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

/**
 * GroupControllerTest class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GroupControllerTest extends WebTestCase
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
            'AppBundle\DataFixtures\ORM\LoadGroupData',
        ]);

        $crawler = $this->client->request('GET', '/groups');

        $this->assertStatusCode(200, $this->client);
        $this->assertCount(1, $crawler->filter('table'));
        $this->assertCount(3, $crawler->filter('tr#groups'));
    }

    /**
     * Test Show action
     */
    public function testShowAction()
    {
        $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadGroupData',
            'AppBundle\DataFixtures\ORM\LoadGenreData',
        ]);

        $crawler = $this->client->request('GET', '/group/jinjer');

        $this->assertStatusCode(200, $this->client);
        $this->assertCount(1, $crawler->filter('ul#groups'));
        $this->assertCount(1, $crawler->filter('ul#genres'));
    }

    /**
     * Test Event action
     */
    public function testEventAction()
    {
        $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadEventData',
            'AppBundle\DataFixtures\ORM\LoadGroupData',
            'AppBundle\DataFixtures\ORM\LoadEventGroupData',
        ]);

        $crawler = $this->client->request('GET', '/group/jinjer/events');

        $this->assertStatusCode(200, $this->client);
        $this->assertCount(1, $crawler->filter('table'));
        $this->assertCount(1, $crawler->filter('tr#groups'));
    }

    /**
     * Test AjaxAddToBookmark action
     */
    public function testAjaxAddToBookmarkAction()
    {
        $fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'AppBundle\DataFixtures\ORM\LoadUserGroupData',
            'AppBundle\DataFixtures\ORM\LoadGroupData',
        ])->getReferenceRepository();

        $this->loginAs($fixtures->getReference('user-admin'), 'main');

        $this->client = static::makeClient();

        $this->client->request('GET', '/group/jinjer/bookmark', [], [], [
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
            'AppBundle\DataFixtures\ORM\LoadUserGroupData',
            'AppBundle\DataFixtures\ORM\LoadGroupData',
        ])->getReferenceRepository();

        $this->loginAs($fixtures->getReference('user-admin'), 'main');

        $this->client = static::makeClient();

        $this->client->request('GET', '/group/jinjer/bookmark/delete', [], [], [
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
        ]);

        $this->assertStatusCode(200, $this->client);
    }
}
