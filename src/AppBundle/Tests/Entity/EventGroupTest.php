<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Event;
use AppBundle\Entity\EventGroup;
use AppBundle\Entity\Group;

/**
 * EventGroup Entity Test
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class EventGroupTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty User Group entity
     */
    public function testEmptyEventGroup()
    {
        $groupGenre = new EventGroup();
        $this->assertNull($groupGenre->getId());
        $this->assertNull($groupGenre->getEvent());
        $this->assertNull($groupGenre->getGroup());
    }

    /**
     * Test setter and getter for Event
     */
    public function testSetGetEvent()
    {
        $event = new Event();
        $eventGroup = (new EventGroup())->setEvent($event);
        $this->assertEquals($event, $eventGroup->getEvent());
    }

    /**
     * Test setter and getter for Group
     */
    public function testSetGetGroup()
    {
        $group = new Group();
        $eventGroup = (new EventGroup())->setGroup($group);
        $this->assertEquals($group, $eventGroup->getGroup());
    }
}
