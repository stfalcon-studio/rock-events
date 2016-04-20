<?php

namespace AppBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\HttpFoundation\Response;

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

        $this->assertStatusCode(Response::HTTP_OK, $this->client);
    }

    /**
     * Test add group action
     */
    public function testAddGroupAction()
    {
        $fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'AppBundle\DataFixtures\ORM\LoadGroupData',
            'AppBundle\DataFixtures\ORM\LoadManagerGroupData',
        ])->getReferenceRepository();

        $this->loginAs($fixtures->getReference('user-manager'), 'main');
        $this->client = static::makeClient();

        //GET
        $crawler = $this->client->request('GET', '/manager/group/create');
        $this->assertStatusCode(Response::HTTP_OK, $this->client);

        //POST
        $token = $crawler->filter('[name="group[_token]"]')->attr('value');
        $data  = [
            'group' => [
                'name'        => 'On the Wange',
                'description' => 'Психоделік гурт On the Wane',
                'country'     => 'Україна',
                'city'        => 'Хмельницький',
                'foundedAt'   => 2012,
                '_token'      => $token,
            ],
        ];
        $this->client->request('POST', '/manager/group/create', $data);

        $this->assertStatusCode(Response::HTTP_FOUND, $this->client);
    }

    /**
     * Test list manager groups
     */
    public function testGroupsAction()
    {
        $fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'AppBundle\DataFixtures\ORM\LoadGroupData',
            'AppBundle\DataFixtures\ORM\LoadManagerGroupData',
        ])->getReferenceRepository();

        $this->loginAs($fixtures->getReference('user-manager'), 'main');
        $this->client = static::makeClient();
        $this->client->request('GET', '/manager/groups');

        $this->assertStatusCode(Response::HTTP_OK, $this->client);
    }

    /**
     * Test manager list events for group
     */
    public function testGroupEventsAction()
    {
        $fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'AppBundle\DataFixtures\ORM\LoadGroupData',
            'AppBundle\DataFixtures\ORM\LoadEventData',
            'AppBundle\DataFixtures\ORM\LoadEventGroupData',
            'AppBundle\DataFixtures\ORM\LoadManagerGroupData',
        ])->getReferenceRepository();

        $this->loginAs($fixtures->getReference('user-manager'), 'main');
        $this->client = static::makeClient();
        $this->client->request('GET', '/manager/group/bmth/events');

        $this->assertStatusCode(Response::HTTP_OK, $this->client);
    }

    /**
     * Test add event action
     */
    public function testAddEventAction()
    {
        $fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'AppBundle\DataFixtures\ORM\LoadGroupData',
            'AppBundle\DataFixtures\ORM\LoadEventData',
            'AppBundle\DataFixtures\ORM\LoadEventGroupData',
            'AppBundle\DataFixtures\ORM\LoadManagerGroupData',
        ])->getReferenceRepository();

        $this->loginAs($fixtures->getReference('user-manager'), 'main');
        $this->client = static::makeClient();

        //GET
        $crawler = $this->client->request('GET', '/manager/event/create');
        $this->assertStatusCode(200, $this->client);

        //POST
        $token = $crawler->filter('[name="event_groups[_token]"]')->attr('value');
        $data  = [
            'event_groups' => [
                'name'        => 'Файне місто',
                'description' => 'Файне місто - фестиваль в Тернополі',
                'country'     => 'Україна',
                'city'        => 'Тернопіль',
                'address'     => 'Старий аеропорт',
                'beginAt'     => new \DateTime(),
                'endAt'       => new \DateTime(),
                'groups'      => [
                    '0' => [
                        'slug' => 'shikari',
                    ],
                ],
                '_token'      => $token,
            ],
        ];
        $this->client->request('POST', '/manager/event/create', $data);

        $this->assertStatusCode(Response::HTTP_OK, $this->client);
    }

    public function testListEventsAction()
    {
        $fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'AppBundle\DataFixtures\ORM\LoadGroupData',
            'AppBundle\DataFixtures\ORM\LoadEventData',
            'AppBundle\DataFixtures\ORM\LoadEventGroupData',
            'AppBundle\DataFixtures\ORM\LoadManagerGroupData',
        ])->getReferenceRepository();

        $this->loginAs($fixtures->getReference('user-manager'), 'main');
        $this->client = static::makeClient();
        $this->client->request('GET', '/manager/events');

        $this->assertStatusCode(Response::HTTP_OK, $this->client);
    }

    public function testListPreviousEventsAction()
    {
        $fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'AppBundle\DataFixtures\ORM\LoadGroupData',
            'AppBundle\DataFixtures\ORM\LoadEventData',
            'AppBundle\DataFixtures\ORM\LoadEventGroupData',
            'AppBundle\DataFixtures\ORM\LoadManagerGroupData',
        ])->getReferenceRepository();

        $this->loginAs($fixtures->getReference('user-manager'), 'main');
        $this->client = static::makeClient();
        $this->client->request('GET', '/manager/events/previous');

        $this->assertStatusCode(Response::HTTP_OK, $this->client);
    }
}
