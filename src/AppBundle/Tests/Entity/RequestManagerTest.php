<?php

namespace AppBundle\Tests\Entity;

use AppBundle\DBAL\Types\RequestManagerStatusType;
use AppBundle\Entity\RequestManager;
use AppBundle\Entity\RequestManagerGroup;
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
        $this->assertNull($requestManager->getRequestManagerGroups());
        $this->assertNull($requestManager->getFullName());
        $this->assertNull($requestManager->getPhone());
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
     * Test setter and getter for Status
     */
    public function testSetGetStatus()
    {
        $status = RequestManagerStatusType::SENT;
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
