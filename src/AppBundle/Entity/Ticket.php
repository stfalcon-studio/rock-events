<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Ticket Entity
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @ORM\Table(name="tickets")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TicketRepository")
 *
 * @Gedmo\Loggable
 */
class Ticket
{
    use TimestampableEntity;

    /**
     * @var int $id ID
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Event $event Event
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Event", inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     *
     * @Assert\NotBlank()
     *
     * @Gedmo\Versioned
     */
    private $event;

    /**
     * @var float $price Price
     *
     * @ORM\Column(type="float", nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="float")
     *
     * @Gedmo\Versioned
     */
    private $price;

    /**
     * @var string $linkBuyTicket Link buy ticket
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Gedmo\Versioned
     */
    private $linkToBuyTicket;

    /**
     * Get ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set price
     *
     * @param float $price Price
     *
     * @return Ticket
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float Price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set link to buy ticket
     *
     * @param string $linkToBuyTicket Link to buy ticket
     *
     * @return Ticket
     */
    public function setLinkToBuyTicket($linkToBuyTicket)
    {
        $this->linkToBuyTicket = $linkToBuyTicket;

        return $this;
    }

    /**
     * Get link to buy ticket
     *
     * @return string Link to buy ticket
     */
    public function getLinkToBuyTicket()
    {
        return $this->linkToBuyTicket;
    }

    /**
     * Set event
     *
     * @param Event $event Event
     *
     * @return Ticket
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return Event Event
     */
    public function getEvent()
    {
        return $this->event;
    }
}
