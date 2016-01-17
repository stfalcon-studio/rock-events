<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Event Entity
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @ORM\Table(name="events")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventRepository")
 */
class Event
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
     * @var User $user User created by
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="eventCreatedBy")
     * @ORM\JoinColumn(nullable=true)
     */
    private $createdBy;

    /**
     * @var User $user User updated by
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="eventUpdatedBy")
     * @ORM\JoinColumn(nullable=true)
     */
    private $updatedBy;

    /**
     * @var string $name Name
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="255")
     * @Assert\Type(type="string")
     */
    private $name;

    /**
     * @var string $description Description
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Assert\Type(type="string")
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
     */
    private $city;

    /**
     * @var string $address Address
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Type(type="string")
     */
    private $address;

    /**
     * @var \DateTime $datetimeStart Date time start
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Assert\DateTime()
     */
    private $dateTimeStart;

    /**
     * @var \DateTime $dateTimeEnd Date time end
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Assert\DateTime()
     */
    private $dateTimeEnd;

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
     * Set dateTimeStart
     *
     * @param \DateTime $dateTimeStart Date time start
     *
     * @return Event
     */
    public function setDateTimeStart($dateTimeStart)
    {
        $this->dateTimeStart = $dateTimeStart;

        return $this;
    }

    /**
     * Get dateTimeStart
     *
     * @return \DateTime Date time start
     */
    public function getDateTimeStart()
    {
        return $this->dateTimeStart;
    }

    /**
     * Set dateTimeEnd
     *
     * @param \DateTime $dateTimeEnd Date time end
     *
     * @return Event
     */
    public function setDateTimeEnd($dateTimeEnd)
    {
        $this->dateTimeEnd = $dateTimeEnd;

        return $this;
    }

    /**
     * Get dateTimeEnd
     *
     * @return \DateTime Date time end
     */
    public function getDateTimeEnd()
    {
        return $this->dateTimeEnd;
    }

    /**
     * Set createdBy
     *
     * @param User $createdBy Created by
     *
     * @return Event
     */
    public function setCreatedBy(User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return User Created by
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param User $updatedBy Updated by
     *
     * @return Event
     */
    public function setUpdatedBy(User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return User Updated by
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }
}
