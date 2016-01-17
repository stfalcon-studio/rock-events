<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\User;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * User Entity Test
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty User entity
     */
    public function testEmptyUser()
    {
        $user = new User();
        $this->assertNull($user->getId());
        $this->assertNull($user->getEmail());
        $this->assertNull($user->getUsername());
        $this->assertNull($user->getPassword());
        $this->assertNull($user->getSurname());
        $this->assertNull($user->getName());
        $this->assertNull($user->getCounty());
        $this->assertNull($user->getCity());
        $this->assertNull($user->getPhone());
        $this->assertNull($user->getAddress());
    }

    /**
     * Test setter and getter for Surname
     */
    public function testSetGetSurname()
    {
        $surname = 'Surname';
        $user = (new User())->setSurname($surname);
        $this->assertEquals($surname, $user->getSurname());
    }

    /**
     * Test setter and getter for Name
     */
    public function testSetGetName()
    {
        $name = 'Name';
        $user = (new User())->setName($name);
        $this->assertEquals($name, $user->getName());
    }

    /**
     * Test setter and getter for Country
     */
    public function testSetGetCountry()
    {
        $country = 'Country';
        $user = (new User())->setCounty($country);
        $this->assertEquals($country, $user->getCounty());
    }

    /**
     * Test setter and getter for City
     */
    public function testSetGetCity()
    {
        $city = 'City';
        $user = (new User())->setCity($city);
        $this->assertEquals($city, $user->getCity());
    }

    /**
     * Test setter and getter for Phone
     */
    public function testSetGetPhone()
    {
        $phone = 'Phone';
        $user = (new User())->setPhone($phone);
        $this->assertEquals($phone, $user->getPhone());
    }

    /**
     * Test setter and getter for Address
     */
    public function testSetGetAddress()
    {
        $address = 'Address';
        $user = (new User())->setAddress($address);
        $this->assertEquals($address, $user->getAddress());
    }

    /**
     * Test setter and getter for Expires At
     */
    public function testSetGetExpiresAt()
    {
        $dateTime = new \DateTime();
        $user = (new User())->setExpiresAt($dateTime);
        $this->assertEquals($dateTime, $user->getExpiresAt());
    }

    /**
     * Test setter and getter for Credentials Expire At
     */
    public function testSetGetCredentialsExpireAt()
    {
        $dateTime = new \DateTime();
        $user = (new User())->setCredentialsExpireAt($dateTime);
        $this->assertEquals($dateTime, $user->getCredentialsExpireAt());
    }

    /**
     * Test getter for Users Groups collection
     */
    public function testGetUsersGroupsCollection()
    {
        $user = new User();
        $this->assertEquals(null, $user->getUsersGroups());
    }

    /**
     * Test getter for Users Genres collection
     */
    public function testGetUsersGenresCollection()
    {
        $user = new User();
        $this->assertEquals(null, $user->getUsersGenres());
    }

    /**
     * Test getter for Groups Created By collection
     */
    public function testGetGroupsCreatedByCollection()
    {
        $user = new User();
        $this->assertEquals(null, $user->getGroupsCreatedBy());
    }

    /**
     * Test getter for Groups Updated By collection
     */
    public function testGetGroupsUpdatedByCollection()
    {
        $user = new User();
        $this->assertEquals(null, $user->getGroupsUpdatedBy());
    }

    /**
     * Test getter for Genres Updated By collection
     */
    public function testGetGenresCreatedByCollection()
    {
        $user = new User();
        $this->assertEquals(null, $user->getGenresCreatedBy());
    }

    /**
     * Test getter for Genres Updated By collection
     */
    public function testGetGenresUpdatedByCollection()
    {
        $user = new User();
        $this->assertEquals(null, $user->getGenresUpdatedBy());
    }

    /**
     * Test getter for Events Created By collection
     */
    public function testGetEventCreatedByCollection()
    {
        $user = new User();
        $this->assertEquals(null, $user->getEventsCreatedBy());
    }

    /**
     * Test getter for Events updated By collection
     */
    public function testGetEventUpdatedByCollection()
    {
        $user = new User();
        $this->assertEquals(null, $user->getEventsupdatedBy());
    }

    /**
     * Test getter for Tickets collection
     */
    public function testGetTicketsCollection()
    {
        $user = new User();
        $this->assertEquals(null, $user->getTickets());
    }
}