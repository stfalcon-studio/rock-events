<?php

namespace AppBundle\Tests\Entity;

use AppBundle\DBAL\Types\RequestManagerStatusType;
use AppBundle\Entity\Group;
use AppBundle\Entity\RequestManager;
use AppBundle\Entity\RequestManagerGroup;
use AppBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * RequestRightTest class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class RequestManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty Request Manager entity
     */
    public function testEmptyRequestManager()
    {
        $requestManager = new RequestManager();
        $this->assertNull($requestManager->getId());
        $this->assertNull($requestManager->getUser());
        $this->assertNull($requestManager->getRequestManagerGroups());
        $this->assertNull($requestManager->getUser());
        $this->assertNull($requestManager->getSurname());
        $this->assertNull($requestManager->getName());
        $this->assertNull($requestManager->getPhone());
    }

    /**
     * Test setter and getter for User
     */
    public function testSetGetUser()
    {
        $user         = new User();
        $requestManager = (new RequestManager())->setUser($user);
        $this->assertEquals($user, $requestManager->getUser());
    }

    /**
     * Test setter and getter for Text
     */
    public function testSetGetText()
    {
        $text = 'Some text';
        $requestManager = (new RequestManager())->setText($text);
        $this->assertEquals($text, $requestManager->getText());
    }

    /**
     * Test setter and getter for Surname
     */
    public function testSetGetSurname()
    {
        $surname = 'Some surname';
        $requestManager = (new RequestManager())->setSurname($surname);
        $this->assertEquals($surname, $requestManager->getSurname());
    }

    /**
     * Test setter and getter for Name
     */
    public function testSetGetName()
    {
        $name = 'Some name';
        $requestManager = (new RequestManager())->setName($name);
        $this->assertEquals($name, $requestManager->getName());
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
     * Test setter and getter for Status
     */
    public function testSetGetStatus()
    {
        $status = RequestManagerStatusType::SENDED;
        $requestManager = (new RequestManager())->setStatus($status);
        $this->assertEquals($status, $requestManager->getStatus());
    }

    /**
     * Test getter for Request Manager Group collection
     */
    public function testGetSetRequestManagerGroupCollection()
    {
        $requestManagerGroups = new ArrayCollection();
        $requestManagerGroups->add(new RequestManagerGroup());
        $requestManager = (new RequestManager())->setRequestManagerGroups($requestManagerGroups);
        $this->assertEquals(1, $requestManager->getRequestManagerGroups()->count());
        $this->assertEquals($requestManagerGroups, $requestManager->getRequestManagerGroups());
    }
}
