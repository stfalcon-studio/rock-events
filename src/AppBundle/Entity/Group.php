<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Group Entity
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @ORM\Table(name="groups")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupRepository")
 */
class Group
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
     *
     * @var ArrayCollection|UserGroup[] $usersGroups Users Groups
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserGroup", mappedBy="group")
     */
    private $usersGroups;

    /**
     * @var User $user User created by
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="groupCreatedBy")
     * @ORM\JoinColumn(nullable=true)
     */
    private $createdBy;

    /**
     * @var User $user User updated by
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="groupUpdatedBy")
     * @ORM\JoinColumn(nullable=true)
     */
    private $updatedBy;

    /**
     * @var string $name Name
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="100")
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
     * @var string $county County
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @Assert\Type(type="string")
     */
    private $country;

    /**
     * @var string $city City
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @Assert\Type(type="string")
     */
    private $city;

    /**
     * @var int $yearFoundation Year foundation
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Assert\Type(type="integer")
     */
    private $yearFoundation;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usersGroups = new ArrayCollection();
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
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * Set year foundation
     *
     * @param int $yearFoundation Year foundation
     *
     * @return Group
     */
    public function setYearFoundation($yearFoundation)
    {
        $this->yearFoundation = $yearFoundation;

        return $this;
    }

    /**
     * Get year foundation
     *
     * @return int Year foundation
     */
    public function getYearFoundation()
    {
        return $this->yearFoundation;
    }

    /**
     * Get users groups
     *
     * @return UserGroup[]|ArrayCollection Users Groups
     */
    public function getUsersGroups()
    {
        return $this->usersGroups;
    }

    /**
     * Get created by user
     *
     * @return User Created by user
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set created by user
     *
     * @param User $createdBy Created by user
     *
     * @return $this
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * Get updated by user
     *
     * @return User Updated by user
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set updated by user
     *
     * @param User $updatedBy Updated by user
     *
     * @return $this
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
    }
}
