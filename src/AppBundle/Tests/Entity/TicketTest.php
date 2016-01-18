<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Ticket;
use AppBundle\Entity\User;

/**
 * Ticket Entity Test
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class TicketTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test an empty Ticket entity
     */
    public function testEmptyTicket()
    {
        $ticket = new Ticket();
        $this->assertNull($ticket->getId());
        $this->assertNull($ticket->getUser());
        $this->assertNull($ticket->getEvent());
        $this->assertNull($ticket->getPrice());
    }

    /**
     * Test setter and getter for Price
     */
    public function testSetGetPrice()
    {
        $price  = 'Price';
        $ticket = (new Ticket())->setPrice($price);
        $this->assertEquals($price, $ticket->getPrice());
    }

    /**
     * Test setter and getter for User
     */
    public function testSetGetUser()
    {
        $user   = new User();
        $ticket = (new Ticket())->setUser($user);
        $this->assertEquals($user, $ticket->getUser());
    }
}