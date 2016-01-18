<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Genre;
use AppBundle\Entity\User;
use AppBundle\Entity\UserGenre;

/**
 * UserGenre Entity Test
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class UserGenreTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty User Genre entity
     */
    public function testEmptyUserGenre()
    {
        $userGenre = new UserGenre();
        $this->assertNull($userGenre->getId());
        $this->assertNull($userGenre->getUser());
        $this->assertNull($userGenre->getGenre());
    }

    /**
     * Test setter and getter for User
     */
    public function testSetGetUser()
    {
        $user      = new User();
        $userGenre = (new UserGenre())->setUser($user);
        $this->assertEquals($user, $userGenre->getUser());
    }

    /**
     * Test setter and getter for Genre
     */
    public function testSetGetGenre()
    {
        $genre     = new Genre();
        $userGenre = (new UserGenre())->setGenre($genre);
        $this->assertEquals($genre, $userGenre->getGenre());
    }
}