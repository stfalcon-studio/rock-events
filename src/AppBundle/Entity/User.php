<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User Entity
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    use TimestampableEntity;

    /**
     * @var int $id ID
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection|UserGroup[] $usersGroups Users Groups
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserGroup", mappedBy="user")
     */
    private $usersGroups;

    /**
     * @var ArrayCollection|UserGenre[] $usersGenres Users Genres
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserGenre", mappedBy="user")
     */
    private $usersGenres;

    /**
     * @var ArrayCollection|Group[] $groupsCreatedBy Group created by
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Group", mappedBy="createdBy")
     */
    private $groupsCreatedBy;

    /**
     * @var ArrayCollection|Group[] $groupsUpdatedBy Group updated by
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Group", mappedBy="updatedBy")
     */
    private $groupsUpdatedBy;

    /**
     * @var ArrayCollection|Genre[] $genresCreatedBy Genre created by
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Genre", mappedBy="createdBy")
     */
    private $genresCreatedBy;

    /**
     * @var ArrayCollection|Genre[] $genresUpdatedBy Genre updated by
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Genre", mappedBy="updatedBy")
     */
    private $genresUpdatedBy;

    /**
     * @var ArrayCollection|Event[] $eventsCreatedBy Event created by
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Event", mappedBy="createdBy")
     */
    private $eventsCreatedBy;

    /**
     * @var ArrayCollection|Event[] $eventsUpdatedBy Event updated by
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Event", mappedBy="updatedBy")
     */
    private $eventsUpdatedBy;

    /**
     * @var ArrayCollection|Ticket[] $tickets Ticket
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ticket", mappedBy="user")
     */
    private $tickets;

    /**
     * @var string $surname Surname
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="100")
     * @Assert\Type(type="string")
     */
    private $surname;

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
     * @var string $county County
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @Assert\Type(type="string")
     */
    private $county;

    /**
     * @var string $city City
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Type(type="string")
     */
    private $city;

    /**
     * @var string $address Address
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Type(type="string")
     */
    private $address;

    /**
     * @var string $phone Phone
     *
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Assert\Type(type="string")
     */
    private $phone;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        // By default all users are admins
        $this->roles = ['ROLE_ADMIN'];
    }

    /**
     * Get expires at
     *
     * @return \DateTime Expires at
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Get credentials expire at
     *
     * @return \DateTime Credentials expire at
     */
    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }


    /**
     * Set surname
     *
     * @param string $surname Surname
     *
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string Surname
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set name
     *
     * @param string $name Name
     *
     * @return User
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
     * Set county
     *
     * @param string $county Country
     *
     * @return User
     */
    public function setCounty($county)
    {
        $this->county = $county;

        return $this;
    }

    /**
     * Get county
     *
     * @return string Country
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * Set city
     *
     * @param string $city City
     *
     * @return User
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
     * @return User
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
     * Set phone
     *
     * @param string $phone Phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string Phone
     */
    public function getPhone()
    {
        return $this->phone;
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
     * Get users genres
     *
     * @return UserGenre[]|ArrayCollection Users Genres
     */
    public function getUsersGenres()
    {
        return $this->usersGenres;
    }

    /**
     * Get groups created by
     *
     * @return Group[]|ArrayCollection Groups created by
     */
    public function getGroupsCreatedBy()
    {
        return $this->groupsCreatedBy;
    }

    /**
     * Get groups updated by
     *
     * @return Group[]|ArrayCollection Groups updated by
     */
    public function getGroupsUpdatedBy()
    {
        return $this->groupsUpdatedBy;
    }

    /**
     * Get genres created by
     *
     * @return Genre[]|ArrayCollection Genres created by
     */
    public function getGenresCreatedBy()
    {
        return $this->genresCreatedBy;
    }

    /**
     * Get genres updated by
     *
     * @return Genre[]|ArrayCollection Genres updated by
     */
    public function getGenresUpdatedBy()
    {
        return $this->genresUpdatedBy;
    }

    /**
     * Get events created by
     *
     * @return Event[]|ArrayCollection Events created by
     */
    public function getEventsCreatedBy()
    {
        return $this->eventsCreatedBy;
    }

    /**
     * Get events updated by
     *
     * @return Event[]|ArrayCollection Events updated by
     */
    public function getEventsUpdatedBy()
    {
        return $this->eventsUpdatedBy;
    }

    /**
     * Get tickets
     *
     * @return Ticket[]|ArrayCollection Tickets
     */
    public function getTickets()
    {
        return $this->tickets;
    }

}
