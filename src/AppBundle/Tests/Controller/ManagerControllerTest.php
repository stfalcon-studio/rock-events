<?php

namespace AppBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

/**
 * ManagerControllerTest
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class ManagerControllerTest extends WebTestCase
{
    /** @var Client $client */
    private $client;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Test dashboard action
     */
    public function testDashboardAction()
    {
        $fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadUserData',
        ])->getReferenceRepository();

        $this->loginAs($fixtures->getReference('user-manager'), 'main');
        $this->client = static::makeClient();
        $this->client->request('GET', '/manager');

        $this->assertStatusCode(200, $this->client);
    }
}
