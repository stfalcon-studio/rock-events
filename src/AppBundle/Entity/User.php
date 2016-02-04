<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User Entity
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 *
 * @Gedmo\Loggable
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
     * @var ArrayCollection|UserGenre[] $userGenres Users Genres
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserGenre", mappedBy="user")
     */
    private $userGenres;

    /**
     * @var ArrayCollection|UserGroup[] $userGroups User Groups
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserGroup", mappedBy="user")
     */
    private $userGroups;

    /**
     * @var ArrayCollection|ManagerGroup[] $mangerGroups Manager Groups
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ManagerGroup", mappedBy="manager")
     */
    private $managerGroups;

    /**
     * @var ArrayCollection|RequestManager[] $requestManagers Request Managers
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RequestManager", mappedBy="requestedBy")
     */
    private $requestManagers;

    /**
     * @var string $fullName Full name
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @Assert\Length(min="5", max="100")
     * @Assert\Type(type="string")
     *
     * @Gedmo\Versioned
     */
    private $fullName;

    /**
     * @var string $phone Phone
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     *
     * @Assert\Length(min="5")
     *
     * @Gedmo\Versioned
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
     * Set full name
     *
     * @param string $fullName Full name
     *
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get full name
     *
     * @return string Full name
     */
    public function getFullName()
    {
        return $this->fullName;
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
     * Set user genres
     *
     * @param ArrayCollection|UserGenre[] $userGenres User Genre
     *
     * @return $this
     */
    public function setUserGenres(ArrayCollection $userGenres)
    {
        foreach ($userGenres as $userGenre) {
            $userGenre->setUser($this);
        }
        $this->userGenres = $userGenres;

        return $this;
    }

    /**
     * Get user genres
     *
     * @return ArrayCollection|UserGenre[] User Genres
     */
    public function getUserGenres()
    {
        return $this->userGenres;
    }

    /**
     * Set user groups
     *
     * @param ArrayCollection|UserGroup[] $userGroups User Groups
     *
     * @return $this
     */
    public function setUserGroups(ArrayCollection $userGroups)
    {
        foreach ($userGroups as $userGroup) {
            $userGroup->setUser($this);
        }
        $this->userGroups = $userGroups;

        return $this;
    }

    /**
     * Get user groups
     *
     * @return ArrayCollection|UserGroup[] User Groups
     */
    public function getUserGroups()
    {
        return $this->userGroups;
    }

    /**
     * Set manager groups
     *
     * @param ArrayCollection|ManagerGroup[] $managerGroups Manager Groups
     *
     * @return $this
     */
    public function setManagerGroups(ArrayCollection $managerGroups)
    {
        foreach ($managerGroups as $managerGroup) {
            $managerGroup->setManager($this);
        }
        $this->managerGroups = $managerGroups;

        return $this;
    }

    /**
     * Get manager groups
     *
     * @return ArrayCollection|ManagerGroup[] Manager Groups
     */
    public function getManagerGroups()
    {
        return $this->managerGroups;
    }

    /**
     * Set manager groups
     *
     * @param ArrayCollection|RequestManager[] $requestManagers Request Manager
     *
     * @return $this
     */
    public function setRequestManagers(ArrayCollection $requestManagers)
    {
        foreach ($requestManagers as $requestManager) {
            $requestManager->setRequestedBy($this);
        }
        $this->requestManagers = $requestManagers;

        return $this;
    }

    /**
     * Get manager groups
     *
     * @return ArrayCollection|RequestManager[] Request Manager
     */
    public function getRequestManager()
    {
        return $this->requestManagers;
    }
}
