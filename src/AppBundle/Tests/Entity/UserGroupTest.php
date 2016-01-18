<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Group;
use AppBundle\Entity\User;
use AppBundle\Entity\UserGroup;

/**
 * UserGroup Entity Test
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class UserGroupTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty User Group entity
     */
    public function testEmptyUserGroup()
    {
        $userGroup = new UserGroup();
        $this->assertNull($userGroup->getId());
        $this->assertNull($userGroup->getUser());
        $this->assertNull($userGroup->getGroup());
    }

    /**
     * Test setter and getter for User
     */
    public function testSetGetUser()
    {
        $user      = new User();
        $userGroup = (new UserGroup())->setUser($user);
        $this->assertEquals($user, $userGroup->getUser());
    }

    /**
     * Test setter and getter for Group
     */
    public function testSetGetGroup()
    {
        $group     = new Group();
        $userGroup = (new UserGroup())->setGroup($group);
        $this->assertEquals($group, $userGroup->getGroup());
    }
}