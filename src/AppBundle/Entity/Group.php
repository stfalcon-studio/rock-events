<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Group Entity
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @ORM\Table(name="groups")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupRepository")
 *
 * @Gedmo\Loggable
 */
class Group
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
     *
     * @var ArrayCollection|GroupGenre[] $groupGenres Group Genres
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\GroupGenre", mappedBy="group")
     */
    private $groupGenres;

    /**
     *
     * @var ArrayCollection|UserGroup[] $usersGroups User Groups
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserGroup", mappedBy="group")
     */
    private $userGroups;

    /**
     *
     * @var ArrayCollection|EventGroup[] $eventGroups Event Groups
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\EventGroup", mappedBy="group")
     */
    private $eventGroups;

    /**
     * @var ArrayCollection|ManagerGroup[] $managerGroups Manager Groups
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ManagerGroup", mappedBy="group")
     */
    private $managerGroups;

    /**
     * @var string $name Name
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="100")
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
     * @var \Datetime $foundedAt founded at
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Assert\Type(type="datetime")
     *
     * @Gedmo\Versioned
     */
    private $foundedAt;

    /**
     * @var string $slug Slug
     *
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @var bool $active Active
     *
     * @ORM\Column(type="boolean")
     *
     * @Gedmo\Versioned
     */
    public $active = true;

    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        $result = $this->getName();
        if (null === $result) {
            return "New Group";
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
     * Set founded at
     *
     * @param \DateTime $foundedAt founded at
     *
     * @return Group
     */
    public function setFoundedAt($foundedAt)
    {
        $this->foundedAt = $foundedAt;

        return $this;
    }

    /**
     * Get founded At
     *
     * @return \DateTime Founded At
     */
    public function getFoundedAt()
    {
        return $this->foundedAt;
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
     *
     * Set active
     *
     * @param bool $active Active
     *
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set group genres
     *
     * @param ArrayCollection|GroupGenre[] $groupGenres Group Genres
     *
     * @return $this
     */
    public function setGroupGenres(ArrayCollection $groupGenres)
    {
        foreach ($groupGenres as $groupGenre) {
            $groupGenre->setGroup($this);
        }
        $this->groupGenres = $groupGenres;

        return $this;
    }

    /**
     * Get group genres
     *
     * @return ArrayCollection|GroupGenre[] Group Genres
     */
    public function getGroupGenres()
    {
        return $this->groupGenres;
    }

    /**
     * Set user groups
     *
     * @param ArrayCollection|UserGroup[] $userGroups User Group
     *
     * @return $this
     */
    public function setUserGroups(ArrayCollection $userGroups)
    {
        foreach ($userGroups as $userGroup) {
            $userGroup->setGroup($this);
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
     * Set event groups
     *
     * @param ArrayCollection|EventGroup[] $eventGroups Event Groups
     *
     * @return $this
     */
    public function setEventGroups(ArrayCollection $eventGroups)
    {
        foreach ($eventGroups as $eventGroup) {
            $eventGroup->setGroup($this);
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

    /**
     * Set manager groups
     *
     * @param ArrayCollection|ManagerGroup[] $managerGroups Manager Group
     *
     * @return $this
     */
    public function setManagerGroups(ArrayCollection $managerGroups)
    {
        foreach ($managerGroups as $managerGroup) {
            $managerGroup->setGroup($this);
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
}
