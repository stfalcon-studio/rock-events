<?php

namespace AppBundle\Tests\Entity;
use AppBundle\Entity\Event;
use AppBundle\Entity\User;

/**
 * Event Entity Test
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class EventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty Genre entity
     */
    public function testEmptyUser()
    {
        $event = new Event();
        $this->assertNull($event->getId());
        $this->assertNull($event->getName());
        $this->assertNull($event->getDescription());
        $this->assertNull($event->getCountry());
        $this->assertNull($event->getCity());
        $this->assertNull($event->getAddress());
        $this->assertNull($event->getDateTimeStart());
        $this->assertNull($event->getDateTimeEnd());
        $this->assertNull($event->getCreatedBy());
        $this->assertNull($event->getUpdatedBy());
    }

    /**
     * Test setter and getter for Name
     */
    public function testSetGetName()
    {
        $name = 'Name';
        $event = (new Event())->setName($name);
        $this->assertEquals($name, $event->getName());
    }

    /**
     * Test setter and getter for Description
     */
    public function testSetGetDescription()
    {
        $description = 'Description';
        $event = (new Event())->setDescription($description);
        $this->assertEquals($description, $event->getDescription());
    }

    /**
     * Test setter and getter for Country
     */
    public function testSetGetCountry()
    {
        $country = 'Country';
        $event = (new Event())->setCountry($country);
        $this->assertEquals($country, $event->getCountry());
    }

    /**
     * Test setter and getter for City
     */
    public function testSetGetCity()
    {
        $city = 'City';
        $event = (new Event())->setCity($city);
        $this->assertEquals($city, $event->getCity());
    }

    /**
     * Test setter and getter for Address
     */
    public function testSetGetAddress()
    {
        $address = 'Address';
        $event = (new Event())->setAddress($address);
        $this->assertEquals($address, $event->getAddress());
    }

    /**
     * Test setter and getter for Date time start
     */
    public function testSetGetDateTimeStart()
    {
        $dateTimeStart = new \DateTime();
        $event = (new Event())->setDateTimeStart($dateTimeStart);
        $this->assertEquals($dateTimeStart, $event->getDateTimeStart());
    }

    /**
     * Test setter and getter for Date time End
     */
    public function testSetGetDateTimeEnd()
    {
        $dateTimeEnd = new \DateTime();
        $event = (new Event())->setDateTimeEnd($dateTimeEnd);
        $this->assertEquals($dateTimeEnd, $event->getDateTimeEnd());
    }

    /**
     * Test setter and getter for Created By
     */
    public function testCreatedBy()
    {
        $createdBy = new User();
        $event = (new Event())->setCreatedBy($createdBy);
        $this->assertEquals($createdBy, $event->getCreatedBy());
    }

    /**
     * Test setter and getter for Updated By
     */
    public function testUpdatedBy()
    {
        $updatedBy = new User();
        $event = (new Event())->setUpdatedBy($updatedBy);
        $this->assertEquals($updatedBy, $event->getUpdatedBy());
    }

    /**
     * Test getter for Tickets collection
     */
    public function testGetTicketsCollection()
    {
        $event = new Event();
        $this->assertEquals(null, $event->getTickets());
    }

    /**
     * Test getter for Events Groups collection
     */
    public function testGetEventsGroupsCollection()
    {
        $event = new Event();
        $this->assertEquals(null, $event->getEventsGroups());
    }

}
