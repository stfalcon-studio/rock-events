<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Group;
use AppBundle\Entity\User;
use AppBundle\Entity\ManagerGroup;

/**
 * ManagerGroup Entity Test
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class ManagerGroupTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty User Manager entity
     */
    public function testEmptyUserGroup()
    {
        $userGroup = new ManagerGroup();
        $this->assertNull($userGroup->getId());
        $this->assertNull($userGroup->getManager());
        $this->assertNull($userGroup->getGroup());
    }

    /**
     * Test setter and getter for Manager
     */
    public function testSetGetManager()
    {
        $user      = new User();
        $userGroup = (new ManagerGroup())->setManager($user);
        $this->assertEquals($user, $userGroup->getManager());
    }

    /**
     * Test setter and getter for Group
     */
    public function testSetGetGroup()
    {
        $group     = new Group();
        $userGroup = (new ManagerGroup())->setGroup($group);
        $this->assertEquals($group, $userGroup->getGroup());
    }
}
