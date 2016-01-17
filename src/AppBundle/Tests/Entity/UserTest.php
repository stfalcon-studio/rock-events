<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\User;

/**
 * UserTest
 *
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test creation of new entity
     */
    public function testCreateNewEntity()
    {
        $user = new User();
        $this->assertNull($user->getId());
        $this->assertFalse($user->isEnabled());
        $this->assertNull($user->getCreatedAt());
        $this->assertNull($user->getUpdatedAt());
    }

    /**
     * Test setter and getter for `enabled` field
     */
    public function testSetIsEnabled()
    {
        $company = (new User())->setEnabled(true);
        $this->assertEquals(true, $company->isEnabled());

        $company->setEnabled(false);
        $this->assertFalse($company->isEnabled());
    }

    /**
     * Test setter and getter for `createdAt` field
     */
    public function testSetGetCreatedAt()
    {
        $now = new \DateTime();

        $user = (new User())->setCreatedAt($now);
        $this->assertEquals($now, $user->getCreatedAt());
    }

    /**
     * Test setter and getter for `updatedAt` field
     */
    public function testSetGetUpdatedAt()
    {
        $now = new \DateTime();

        $user = (new User())->setUpdatedAt($now);
        $this->assertEquals($now, $user->getUpdatedAt());
    }
}
