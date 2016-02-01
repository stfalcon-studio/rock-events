<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Group;
use AppBundle\Entity\RequestManager;
use AppBundle\Entity\RequestManagerGroup;

/**
 * RequestManagerGroupTest class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class RequestManagerGroupTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty Request Manager Group entity
     */
    public function testEmptyRequestManagerGroupGroup()
    {
        $requestManagerGroup = new RequestManagerGroup();
        $this->assertNull($requestManagerGroup->getId());
        $this->assertNull($requestManagerGroup->getRequestManager());
        $this->assertNull($requestManagerGroup->getGroup());
    }

    /**
     * Test setter and getter for Request Manager
     */
    public function testSetGetRequestManager()
    {
        $requestManager = new RequestManager();
        $requestManagerGroup = (new RequestManagerGroup())->setRequestManager($requestManager);
        $this->assertEquals($requestManager, $requestManagerGroup->getRequestManager());
    }

    /**
     * Test setter and getter for Group
     */
    public function testSetGetGroup()
    {
        $group = new Group();
        $requestManagerGroup = (new RequestManagerGroup())->setGroup($group);
        $this->assertEquals($group, $requestManagerGroup->getGroup());
    }
}
