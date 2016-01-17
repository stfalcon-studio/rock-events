<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Genre;
use AppBundle\Entity\Group;
use AppBundle\Entity\GroupGenre;

/**
 * GroupGenre Entity Test
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GroupGenreTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty Group Genre entity
     */
    public function testEmptyUserGroup()
    {
        $groupGenre = new GroupGenre();
        $this->assertNull($groupGenre->getId());
        $this->assertNull($groupGenre->getGroup());
        $this->assertNull($groupGenre->getGenre());
    }

    /**
     * Test setter and getter for Genre
     */
    public function testSetGetGenre()
    {
        $user = new Genre();
        $groupGenre = (new GroupGenre())->setGenre($user);
        $this->assertEquals($user, $groupGenre->getGenre());
    }

    /**
     * Test setter and getter for Group
     */
    public function testSetGetGroup()
    {
        $group = new Group();
        $groupGenre = (new GroupGenre())->setGroup($group);
        $this->assertEquals($group, $groupGenre->getGroup());
    }
}
