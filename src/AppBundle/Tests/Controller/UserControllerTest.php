<?php

namespace AppBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\HttpFoundation\Response;

/**
 * UserControllerTest
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class UserControllerTest extends WebTestCase
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
     * Test future event action
     */
    public function testFutureEventsAction()
    {
        $fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadGroupData',
            'AppBundle\DataFixtures\ORM\LoadGenreData',
            'AppBundle\DataFixtures\ORM\LoadGroupGenreData',
            'AppBundle\DataFixtures\ORM\LoadUserGroupData',
            'AppBundle\DataFixtures\ORM\LoadUserGenreData',
            'AppBundle\DataFixtures\ORM\LoadEventData',
            'AppBundle\DataFixtures\ORM\LoadEventGroupData',
        ])->getReferenceRepository();

        $this->loginAs($fixtures->getReference('user-admin'), 'main');

        $this->client = static::makeClient();
        $crawler      = $this->client->request('GET', '/cabinet');

        $this->assertStatusCode(Response::HTTP_OK, $this->client);
        $this->assertCount(1, $crawler->filter('table'));
        $this->assertCount(11, $crawler->filter('tr#events'));
    }

    /**
     * Test group action
     */
    public function testGroupAction()
    {
        $fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadGroupData',
            'AppBundle\DataFixtures\ORM\LoadUserGroupData',
        ])->getReferenceRepository();

        $this->loginAs($fixtures->getReference('user-admin'), 'main');

        $this->client = static::makeClient();
        $crawler      = $this->client->request('GET', '/cabinet/groups');

        $this->assertStatusCode(Response::HTTP_OK, $this->client);
        $this->assertCount(1, $crawler->filter('table'));
    }

    /**
     * Test genre action
     */
    public function testGenreAction()
    {
        $fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadGenreData',
            'AppBundle\DataFixtures\ORM\LoadUserGenreData',
        ])->getReferenceRepository();

        $this->loginAs($fixtures->getReference('user-admin'), 'main');

        $this->client = static::makeClient();
        $crawler      = $this->client->request('GET', '/cabinet/genres');

        $this->assertStatusCode(Response::HTTP_OK, $this->client);
        $this->assertCount(1, $crawler->filter('table'));
    }

    /**
     * Request on granting rights manager
     */
    public function testRightManagerAction()
    {
        $fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'AppBundle\DataFixtures\ORM\LoadGroupData',
            'AppBundle\DataFixtures\ORM\LoadRequestManagerData',
            'AppBundle\DataFixtures\ORM\LoadRequestManagerGroupData',
        ])->getReferenceRepository();

        $this->loginAs($fixtures->getReference('user-admin'), 'main');

        //GET
        $this->client = static::makeClient();

        $crawler = $this->client->request('GET', '/cabinet/request-manager');

        //POST
        $token = $crawler->filter('[name="request_manager[_token]"]')->attr('value');
        $data  = [
            'request_manager' => [
                'fullName' => 'Олекcієнко Марія Вікторівна',
                'phone'    => '0974567233',
                'text'     => 'Заявка',
                'groups'   => [
                    0 => [
                        'slug' => 'shikari',
                    ],
                ],
                '_token'   => $token,
            ],
        ];
        $this->client->request('POST', '/cabinet/request-manager', $data);

        $this->assertStatusCode(Response::HTTP_FOUND, $this->client);
    }
}
