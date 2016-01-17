<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Group;
use AppBundle\Entity\User;

/**
 * Group Entity Test
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GroupTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty Group entity
     */
    public function testEmptyGroup()
    {
        $group = new Group();
        $this->assertNull($group->getId());
        $this->assertNull($group->getName());
        $this->assertNull($group->getDescription());
        $this->assertNull($group->getCountry());
        $this->assertNull($group->getCity());
        $this->assertNull($group->getYearFoundation());
        $this->assertNull($group->getCreatedBy());
        $this->assertNull($group->getUpdatedBy());
    }

    /**
     * Test setter and getter for Name
     */
    public function testSetGetName()
    {
        $name = 'Name';
        $group = (new Group())->setName($name);
        $this->assertEquals($name, $group->getName());
    }

    /**
     * Test setter and getter for Description
     */
    public function testSetGetDescription()
    {
        $name = 'Description';
        $group = (new Group())->setDescription($name);
        $this->assertEquals($name, $group->getDescription());
    }

    /**
     * Test setter and getter for City
     */
    public function testSetGetCity()
    {
        $name = 'City';
        $group = (new Group())->setCity($name);
        $this->assertEquals($name, $group->getCity());
    }

    /**
     * Test setter and getter for Year Foundation
     */
    public function testSetGetYearFoundation()
    {
        $name = 'Year Foundation';
        $group = (new Group())->setYearFoundation($name);
        $this->assertEquals($name, $group->getYearFoundation());
    }

    /**
     * Test setter and getter for Country
     */
    public function testSetGetCountry()
    {
        $country = 'Country';
        $group = (new Group())->setCountry($country);
        $this->assertEquals($country, $group->getCountry());
    }

    /**
     * Test setter and getter for Created By
     */
    public function testCreatedBy()
    {
        $createdBy = new User();
        $group = (new Group())->setCreatedBy($createdBy);
        $this->assertEquals($createdBy, $group->getCreatedBy());
    }

    /**
     * Test setter and getter for Updated By
     */
    public function testUpdatedBy()
    {
        $updatedBy = new User();
        $group = (new Group())->setUpdatedBy($updatedBy);
        $this->assertEquals($updatedBy, $group->getUpdatedBy());
    }

    /**
     * Test getter for Users Groups collection
     */
    public function testGetUsersGroupsCollection()
    {
        $group = new Group();
        $this->assertEquals(null, $group->getUsersGroups());
    }

    /**
     * Test getter for Groups Genres collection
     */
    public function testGetGroupsGenresCollection()
    {
        $group = new Group();
        $this->assertEquals(null, $group->getGroupsGenres());
    }

}
