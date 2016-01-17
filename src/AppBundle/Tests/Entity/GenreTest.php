<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Genre;
use AppBundle\Entity\User;

/**
 * Genre Entity Test
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GenreTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty Genre entity
     */
    public function testEmptyGenre()
    {
        $genre = new Genre();
        $this->assertNull($genre->getId());
        $this->assertNull($genre->getName());
        $this->assertNull($genre->getCreatedBy());
        $this->assertNull($genre->getUpdatedBy());
    }

    /**
     * Test setter and getter for Name
     */
    public function testSetGetName()
    {
        $name = 'Name';
        $genre = (new Genre())->setName($name);
        $this->assertEquals($name, $genre->getName());
    }

    /**
     * Test setter and getter for created by
     */
    public function testSetGetCreatedBy()
    {
        $user = new User();
        $genre = (new Genre())->setCreatedBy($user);
        $this->assertEquals($user, $genre->getCreatedBy());
    }

    /**
     * Test setter and getter for created by
     */
    public function testSetGetUpdatedBy()
    {
        $user = new User();
        $genre = (new Genre())->setUpdatedBy($user);
        $this->assertEquals($user, $genre->getUpdatedBy());
    }

    /**
     * Test getter for Users Genres collection
     */
    public function testGetUsersGenresCollection()
    {
        $genre = new Genre();
        $this->assertEquals(null, $genre->getUsersGenres());
    }

    /**
     * Test getter for Groups Genres collection
     */
    public function testGetGroupsGenresCollection()
    {
        $genre = new Genre();
        $this->assertEquals(null, $genre->getGroupsGenres());
    }
}
