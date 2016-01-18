<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Event;
use AppBundle\Entity\EventGroup;
use AppBundle\Entity\Ticket;
use AppBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

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
        $this->assertNull($event->getBeginAt());
        $this->assertNull($event->getEndAt());
        $this->assertNull($event->getCreatedBy());
        $this->assertNull($event->getUpdatedBy());
    }

    /**
     * Test setter and getter for Name
     */
    public function testSetGetName()
    {
        $name  = 'Name';
        $event = (new Event())->setName($name);
        $this->assertEquals($name, $event->getName());
    }

    /**
     * Test setter and getter for Description
     */
    public function testSetGetDescription()
    {
        $description = 'Description';
        $event       = (new Event())->setDescription($description);
        $this->assertEquals($description, $event->getDescription());
    }

    /**
     * Test setter and getter for Country
     */
    public function testSetGetCountry()
    {
        $country = 'Country';
        $event   = (new Event())->setCountry($country);
        $this->assertEquals($country, $event->getCountry());
    }

    /**
     * Test setter and getter for City
     */
    public function testSetGetCity()
    {
        $city  = 'City';
        $event = (new Event())->setCity($city);
        $this->assertEquals($city, $event->getCity());
    }

    /**
     * Test setter and getter for Address
     */
    public function testSetGetAddress()
    {
        $address = 'Address';
        $event   = (new Event())->setAddress($address);
        $this->assertEquals($address, $event->getAddress());
    }

    /**
     * Test setter and getter for Begin At
     */
    public function testSetGetBeginAt()
    {
        $beginAt = new \DateTime();
        $event   = (new Event())->setBeginAt($beginAt);
        $this->assertEquals($beginAt, $event->getBeginAt());
    }

    /**
     * Test setter and getter for End At
     */
    public function testSetGetEndAt()
    {
        $endAt = new \DateTime();
        $event = (new Event())->setEndAt($endAt);
        $this->assertEquals($endAt, $event->getEndAt());
    }

    /**
     * Test setter and getter Duration
     */
    public function testSetGetDuration()
    {
        $duration = 3.5;
        $event    = (new Event())->setDuration($duration);
        $this->assertEquals($duration, $event->getDuration());
    }

    /**
     * Test setter and getter for Created By
     */
    public function testCreatedBy()
    {
        $createdBy = new User();
        $event     = (new Event())->setCreatedBy($createdBy);
        $this->assertEquals($createdBy, $event->getCreatedBy());
    }

    /**
     * Test setter and getter for Updated By
     */
    public function testUpdatedBy()
    {
        $updatedBy = new User();
        $event     = (new Event())->setUpdatedBy($updatedBy);
        $this->assertEquals($updatedBy, $event->getUpdatedBy());
    }

    /**
     * Test getter for Tickets collection
     */
    public function testGetSetTicketsCollection()
    {
        $tickets = new ArrayCollection();
        $tickets->add(new Ticket());
        $event = (new Event())->setTickets($tickets);
        $this->assertEquals(1, $event->getTickets()->count());
        $this->assertEquals($tickets, $event->getTickets());
    }

    /**
     * Test getter for Events Groups collection
     */
    public function testGetSetEventsGroupsCollection()
    {
        $eventGroups = new ArrayCollection();
        $eventGroups->add(new EventGroup());
        $event = (new Event())->setEventGroups($eventGroups);
        $this->assertEquals(1, $event->getEventGroups()->count());
        $this->assertEquals($eventGroups, $event->getEventGroups());
    }
}