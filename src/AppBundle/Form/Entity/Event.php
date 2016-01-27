<?php

namespace AppBundle\Form\Entity;

use AppBundle\Entity\Group;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Event class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class Event
{
    /**
     * @var ArrayCollection|Group[] $groups Groups
     */
    private $groups;

    /**
     * @var string $name Name
     */
    private $name;

    /**
     * @var string $description Description
     */
    private $description;

    /**
     * @var string $country Country
     */
    private $country;

    /**
     * @var string $city City
     */
    private $city;

    /**
     * @var string $address Address
     */
    private $address;

    /**
     * @var \DateTime $beginAt Begin At
     */
    private $beginAt;

    /**
     * @var \DateTime $endAt End At
     */
    private $endAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get groups
     *
     * @return ArrayCollection|Group[] Groups
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Set groups
     *
     * @param array $groups
     *
     * @return Event
     */
    public function setGroups(array $groups)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * Add group
     *
     * @param Group $group Group
     *
     * @return $this
     */
    public function addGroups(Group $group)
    {
        $this->groups->add($group);
    }

    /**
     * Remove group
     *
     * @param Group $group
     */
    public function removeGroups(Group $group)
    {
        $this->groups->remove($group);
    }
}
