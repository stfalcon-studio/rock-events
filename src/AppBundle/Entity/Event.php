<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Event Entity
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @ORM\Table(name="events")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventRepository")
 *
 * @Gedmo\Loggable
 */
class Event
{
    use TimestampableEntity;

    use BlameableEntityTrait;

    /**
     * @var int $id ID
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var ArrayCollection|Ticket[] $tickets Ticket
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ticket", mappedBy="event")
     */
    private $tickets;

    /**
     * @var ArrayCollection|EventGroup[] $eventGroups Event Groups
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\EventGroup", mappedBy="event")
     */
    private $eventGroups;

    /**
     * @var string $name Name
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="255")
     * @Assert\Type(type="string")
     *
     * @Gedmo\Versioned
     */
    private $name;

    /**
     * @var string $description Description
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Assert\Type(type="string")
     *
     * @Gedmo\Versioned
     */
    private $description;

    /**
     * @var string $country Country
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="100")
     * @Assert\Type(type="string")
     *
     * @Gedmo\Versioned
     */
    private $country;

    /**
     * @var string $city City
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="100")
     * @Assert\Type(type="string")
     *
     * @Gedmo\Versioned
     */
    private $city;

    /**
     * @var string $address Address
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Type(type="string")
     *
     * @Gedmo\Versioned
     */
    private $address;

    /**
     * @var \DateTime $beginAt Begin At
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Assert\DateTime()
     *
     * @Gedmo\Versioned
     */
    private $beginAt;

    /**
     * @var \DateTime $endAt End At
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Assert\DateTime()
     *
     * @Gedmo\Versioned
     */
    private $endAt;

    /**
     * @var float $duration
     *
     * @ORM\Column(type="float", nullable=true)
     *
     * @Assert\Type(type="float")
     *
     * @Gedmo\Versioned
     */
    private $duration;

    /**
     * @var string $slug Slug
     *
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @var bool $isActive Is active
     *
     * @ORM\Column(type="boolean")
     *
     * @Gedmo\Versioned
     */
    public $isActive = true;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tickets     = new ArrayCollection();
        $this->eventGroups = new ArrayCollection();
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        $result = $this->getName();
        if (null === $result) {
            $result = 'New Event';
        }

        return $result;
    }

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
     * Set name
     *
     * @param string $name Name
     *
     * @return Event
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description Description
     *
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string Description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set country
     *
     * @param string $country Country
     *
     * @return Event
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set city
     *
     * @param string $city City
     *
     * @return Event
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set address
     *
     * @param string $address Address
     *
     * @return Event
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set begin at
     *
     * @param \DateTime $beginAt Begin at
     *
     * @return Event
     */
    public function setBeginAt($beginAt)
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    /**
     * Get begin at
     *
     * @return \DateTime Begin at
     */
    public function getBeginAt()
    {
        return $this->beginAt;
    }

    /**
     * Set end at
     *
     * @param \DateTime $endAt End at
     *
     * @return Event
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Get end at
     *
     * @return \DateTime End at
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * Set duration
     *
     * @param string $duration Duration
     *
     * @return Event
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string Duration
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set slug
     *
     * @param string $slug Slug
     *
     * @return Genre
     */
    public function setSlug($slug)
    {
        $this->slug = strtolower(str_replace(' ', '-', $slug));

        return $this;
    }

    /**
     * Get slug
     *
     * @return string Slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Is Active?
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * Set isActive
     *
     * @param bool $isActive Active
     *
     * @return $this
     */
    public function setActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Set tickets
     *
     * @param ArrayCollection|Ticket[] $tickets Ticket
     *
     * @return $this
     */
    public function setTickets(ArrayCollection $tickets)
    {
        foreach ($tickets as $ticket) {
            $ticket->setEvent($this);
        }
        $this->tickets = $tickets;

        return $this;
    }

    /**
     * Get tickets
     *
     * @return ArrayCollection|Ticket[] Tickets
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Set event groups
     *
     * @param ArrayCollection|EventGroup[] $eventGroups Event Groups
     *
     * @return $this
     */
    public function setEventGroups(ArrayCollection $eventGroups)
    {
        foreach ($eventGroups as $eventGroup) {
            $eventGroup->setEvent($this);
        }
        $this->eventGroups = $eventGroups;

        return $this;
    }

    /**
     * Get event groups
     *
     * @return ArrayCollection|EventGroup[] Event Groups
     */
    public function getEventGroups()
    {
        return $this->eventGroups;
    }
}
