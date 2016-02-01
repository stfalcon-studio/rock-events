<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\EventGroup;
use AppBundle\Entity\Group;
use AppBundle\Entity\GroupGenre;
use AppBundle\Entity\ManagerGroup;
use AppBundle\Entity\RequestManagerGroup;
use AppBundle\Entity\User;
use AppBundle\Entity\UserGroup;
use Doctrine\Common\Collections\ArrayCollection;

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
        $this->assertNull($group->getCreatedBy());
        $this->assertNull($group->getUpdatedBy());
        $this->assertNull($group->getSlug());
    }

    /**
     * Test __toString method
     */
    public function testToString()
    {
        $group = new Group();
        $this->assertEquals('New Group', $group->__toString());
    }

    /**
     * Test setter and getter for Name
     */
    public function testSetGetName()
    {
        $name  = 'Name';
        $group = (new Group())->setName($name);
        $this->assertEquals($name, $group->getName());
    }

    /**
     * Test setter and getter for Description
     */
    public function testSetGetDescription()
    {
        $name  = 'Description';
        $group = (new Group())->setDescription($name);
        $this->assertEquals($name, $group->getDescription());
    }

    /**
     * Test setter and getter for Founded At
     */
    public function testSetGetFoundedAt()
    {
        $foundedAt = new \DateTime('2016-04-2 20:0:0');
        $group     = (new Group())->setFoundedAt($foundedAt);
        $this->assertEquals($foundedAt, $group->getFoundedAt());
    }

    /**
     * Test setter and getter for Slug
     */
    public function testSetGetSlug()
    {
        $slug  = 'Slug';
        $event = (new Group())->setSlug($slug);
        $this->assertNotEquals($slug, $event->getSlug());
    }

    /**
     * Test setter and getter for Is Active
     */
    public function testSetGetActive()
    {
        $group = (new Group())->setActive(true);
        $this->assertEquals(true, $group->isActive());
    }

    /**
     * Test setter and getter for Created By
     */
    public function testCreatedBy()
    {
        $createdBy = new User();
        $group     = (new Group())->setCreatedBy($createdBy);
        $this->assertEquals($createdBy, $group->getCreatedBy());
    }

    /**
     * Test setter and getter for Updated By
     */
    public function testUpdatedBy()
    {
        $updatedBy = new User();
        $group     = (new Group())->setUpdatedBy($updatedBy);
        $this->assertEquals($updatedBy, $group->getUpdatedBy());
    }

    /**
     * Test getter for User Groups collection
     */
    public function testGetSetUserGroupsCollection()
    {
        $userGroups = new ArrayCollection();
        $userGroups->add(new UserGroup());
        $group = (new Group())->setUserGroups($userGroups);
        $this->assertEquals(1, $group->getUserGroups()->count());
        $this->assertEquals($userGroups, $group->getUserGroups());
    }

    /**
     * Test getter for Group Genres collection
     */
    public function testGetSetGroupGenresCollection()
    {
        $groupGenres = new ArrayCollection();
        $groupGenres->add(new GroupGenre());
        $group = (new Group())->setGroupGenres($groupGenres);
        $this->assertEquals(1, $group->getGroupGenres()->count());
        $this->assertEquals($groupGenres, $group->getGroupGenres());
    }

    /**
     * Test getter for Event Groups collection
     */
    public function testGetSetEventGroupsCollection()
    {
        $eventGroups = new ArrayCollection();
        $eventGroups->add(new EventGroup());
        $group = (new Group())->setEventGroups($eventGroups);
        $this->assertEquals(1, $group->getEventGroups()->count());
        $this->assertEquals($eventGroups, $group->getEventGroups());
    }

    /**
     * Test getter for Manager Groups collection
     */
    public function testGetSetManagerGroupsCollection()
    {
        $managerGroups = new ArrayCollection();
        $managerGroups->add(new ManagerGroup());
        $group = (new Group())->setManagerGroups($managerGroups);
        $this->assertEquals(1, $group->getManagerGroups()->count());
        $this->assertEquals($managerGroups, $group->getManagerGroups());
    }

    /**
     * Test getter for Request Managers collection
     */
    public function testGetSetRequestManagerGroupsCollection()
    {
        $requestManagerGroups = new ArrayCollection();
        $requestManagerGroups->add(new RequestManagerGroup());
        $group = (new Group())->setRequestManagerGroups($requestManagerGroups);
        $this->assertEquals(1, $group->getRequestManagerGroups()->count());
        $this->assertEquals($requestManagerGroups, $group->getRequestManagerGroups());
    }
}
