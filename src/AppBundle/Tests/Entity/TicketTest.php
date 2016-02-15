<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Event;
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
        $this->assertNull($ticket->getEvent());
        $this->assertNull($ticket->getPrice());
        $this->assertNull($ticket->getLinkToBuyTicket());
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

    public function testSetGetLinkToBuyTicket()
    {
        $linkToBuyTicket = 'Some link';
        $ticket = (new Ticket())->setLinkToBuyTicket($linkToBuyTicket);
        $this->assertEquals($linkToBuyTicket, $ticket->getLinkToBuyTicket());
    }

    /**
     * Test setter and getter for Event
     */
    public function testSetGetEvent()
    {
        $event = new Event();
        $ticket = (new Ticket())->setEvent($event);
        $this->assertEquals($event, $ticket->getEvent());
    }
}
