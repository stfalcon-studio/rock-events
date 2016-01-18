<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Genre;
use AppBundle\Entity\GroupGenre;
use AppBundle\Entity\User;
use AppBundle\Entity\UserGenre;
use Doctrine\Common\Collections\ArrayCollection;

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
        $name  = 'Name';
        $genre = (new Genre())->setName($name);
        $this->assertEquals($name, $genre->getName());
    }

    /**
     * Test setter and getter for created by
     */
    public function testSetGetCreatedBy()
    {
        $user  = new User();
        $genre = (new Genre())->setCreatedBy($user);
        $this->assertEquals($user, $genre->getCreatedBy());
    }

    /**
     * Test setter and getter for created by
     */
    public function testSetGetUpdatedBy()
    {
        $user  = new User();
        $genre = (new Genre())->setUpdatedBy($user);
        $this->assertEquals($user, $genre->getUpdatedBy());
    }

    /**
     * Test getter for User Genres collection
     */
    public function testGetSetUserGenresCollection()
    {
        $userGenres = new ArrayCollection();
        $userGenres->add(new UserGenre());
        $genre = (new Genre())->setUserGenres($userGenres);
        $this->assertEquals(1, $genre->getUserGenres()->count());
        $this->assertEquals($userGenres, $genre->getUserGenres());
    }

    /**
     * Test getter for Group Genres collection
     */
    public function testGetSetGroupGenresCollection()
    {
        $groupGenres = new ArrayCollection();
        $groupGenres->add(new GroupGenre());
        $genre = (new Genre())->setGroupGenres($groupGenres);
        $this->assertEquals(1, $genre->getGroupGenres()->count());
        $this->assertEquals($groupGenres, $genre->getGroupGenres());
    }
}
