<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Group;
use AppBundle\Entity\RequestRight;
use AppBundle\Entity\User;

/**
 * RequestRightTest class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class RequestRightTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty Request Right entity
     */
    public function testEmptyRequestRight()
    {
        $requestRight = new RequestRight();
        $this->assertNull($requestRight->getId());
        $this->assertNull($requestRight->getUser());
        $this->assertNull($requestRight->getGroup());
        $this->assertNull($requestRight->getUser());
    }

    /**
     * Test setter and getter for User
     */
    public function testSetGetUser()
    {
        $user         = new User();
        $requestRight = (new RequestRight())->setUser($user);
        $this->assertEquals($user, $requestRight->getUser());
    }

    /**
     * Test setter and getter for User
     */
    public function testSetGetGroup()
    {
        $group        = new Group();
        $requestRight = (new RequestRight())->setGroup($group);
        $this->assertEquals($group, $requestRight->getGroup());
    }

    /**
     * Test setter and getter for Text
     */
    public function testSetGetText()
    {
        $text = 'Some text';
        $requestRight = (new RequestRight())->setText($text);
        $this->assertEquals($text, $requestRight->getText());
    }

    /**
     * Test setter and getter for is Confirm
     */
    public function testSetGetIsConfirm()
    {
        $confirm = true;
        $requestRight = (new RequestRight())->setIsConfirm($confirm);
        $this->assertEquals($confirm, $requestRight->isConfirm());
    }
}
