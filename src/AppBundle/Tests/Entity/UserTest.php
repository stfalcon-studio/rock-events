<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\ManagerGroup;
use AppBundle\Entity\RequestManager;
use AppBundle\Entity\Ticket;
use AppBundle\Entity\User;
use AppBundle\Entity\UserGenre;
use AppBundle\Entity\UserGroup;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * UserTest
 *
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ia>
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test creation of new entity
     */
    public function testCreateNewEntity()
    {
        $user = new User();
        $this->assertNull($user->getId());
        $this->assertFalse($user->isEnabled());
        $this->assertNull($user->getCreatedAt());
        $this->assertNull($user->getUpdatedAt());
        $this->assertNull($user->getFullName());
        $this->assertNull($user->getPhone());
    }

    /**
     * Test setter and getter for fullName
     */
    public function testSetGetFullName()
    {
        $fullName = 'Some fullName';
        $requestManager = (new RequestManager())->setFullName($fullName);
        $this->assertEquals($fullName, $requestManager->getFullName());
    }

    /**
     * Test setter and getter for Phone
     */
    public function testSetGetPhone()
    {
        $phone = 'Some phone';
        $requestManager = (new RequestManager())->setPhone($phone);
        $this->assertEquals($phone, $requestManager->getPhone());
    }

    /**
     * Test setter and getter for `enabled` field
     */
    public function testSetIsEnabled()
    {
        $company = (new User())->setEnabled(true);
        $this->assertEquals(true, $company->isEnabled());

        $company->setEnabled(false);
        $this->assertFalse($company->isEnabled());
    }

    /**
     * Test setter and getter for `createdAt` field
     */
    public function testSetGetCreatedAt()
    {
        $now = new \DateTime();

        $user = (new User())->setCreatedAt($now);
        $this->assertEquals($now, $user->getCreatedAt());
    }

    /**
     * Test setter and getter for `updatedAt` field
     */
    public function testSetGetUpdatedAt()
    {
        $now = new \DateTime();

        $user = (new User())->setUpdatedAt($now);
        $this->assertEquals($now, $user->getUpdatedAt());
    }

    /**
     * Test setter and getter for Expires At
     */
    public function testSetGetExpiresAt()
    {
        $dateTime = new \DateTime();
        $user     = (new User())->setExpiresAt($dateTime);
        $this->assertEquals($dateTime, $user->getExpiresAt());
    }

    /**
     * Test setter and getter for Credentials Expire At
     */
    public function testSetGetCredentialsExpireAt()
    {
        $dateTime = new \DateTime();
        $user     = (new User())->setCredentialsExpireAt($dateTime);
        $this->assertEquals($dateTime, $user->getCredentialsExpireAt());
    }

    /**
     * Test getter for Users Groups collection
     */
    public function testGetSetUsersGroupsCollection()
    {
        $userGroups = new ArrayCollection();
        $userGroups->add(new UserGroup());
        $user = (new User())->setUserGroups($userGroups);
        $this->assertEquals(1, $user->getUserGroups()->count());
        $this->assertEquals($userGroups, $user->getUserGroups());
    }

    /**
     * Test getter for Users Genres collection
     */
    public function testGetSetUsersGenresCollection()
    {
        $userGenres = new ArrayCollection();
        $userGenres->add(new UserGenre());
        $user = (new User())->setUserGenres($userGenres);
        $this->assertEquals(1, $user->getUserGenres()->count());
        $this->assertEquals($userGenres, $user->getUserGenres());
    }

    /**
     * Test getter for Manager Groups collection
     */
    public function testGetSetManagerGroupsCollection()
    {
        $managerGroups = new ArrayCollection();
        $managerGroups->add(new ManagerGroup());
        $user = (new User())->setManagerGroups($managerGroups);
        $this->assertEquals(1, $user->getManagerGroups()->count());
        $this->assertEquals($managerGroups, $user->getManagerGroups());
    }
}
