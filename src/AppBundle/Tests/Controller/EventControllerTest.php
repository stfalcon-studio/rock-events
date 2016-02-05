<?php

namespace AppBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

/**
 * EventControllerTest class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class EventControllerTest extends WebTestCase
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
     * Test index action
     */
    public function testIndexAction()
    {
        $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadEventData',
        ]);

        $this->client->request('GET', '/');

        $this->assertStatusCode(200, $this->client);
    }

    /**
     * Test list action
     */
    public function testListAction()
    {
        $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadEventData',
        ]);

        $crawler = $this->client->request('GET', '/events');

        $this->assertStatusCode(200, $this->client);
        $this->assertCount(1, $crawler->filter('table'));
        $this->assertCount(4, $crawler->filter('tr#event'));
    }

    /**
     * Test show action
     */
    public function testShowAction()
    {
        $fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadGroupData',
            'AppBundle\DataFixtures\ORM\LoadGenreData',
            'AppBundle\DataFixtures\ORM\LoadEventData',
            'AppBundle\DataFixtures\ORM\LoadGroupGenreData',
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'AppBundle\DataFixtures\ORM\LoadUserGenreData',
            'AppBundle\DataFixtures\ORM\LoadUserGroupData',
            'AppBundle\DataFixtures\ORM\LoadEventGroupData',
        ])->getReferenceRepository();

        $this->loginAs($fixtures->getReference('user-manager'), 'main');
        $this->client = static::makeClient();
        $crawler = $this->client->request('GET', '/event/zaxid');

        $this->assertStatusCode(200, $this->client);
        $this->assertCount(1, $crawler->filter('ul#events'));
        $this->assertCount(1, $crawler->filter('ul#groups'));
    }
}
