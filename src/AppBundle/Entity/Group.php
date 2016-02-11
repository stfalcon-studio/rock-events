<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Group Entity
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @ORM\Table(name="groups")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupRepository")
 *
 * @Gedmo\Loggable
 *
 * @Vich\Uploadable
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
     * @var ArrayCollection|RequestManagerGroup[] $requestManagerGroups Request Manager Group
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RequestManagerGroup", mappedBy="group")
     */
    private $requestManagerGroups;

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
     * @var bool $isActive Is active
     *
     * @ORM\Column(type="boolean")
     *
     * @Gedmo\Versioned
     */
    public $isActive = true;

    /**
     * @Vich\UploadableField(mapping="group_image", fileNameProperty="imageName", nullable=true)
     *
     * @var File $imageFile Image File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string $imageName Image name
     */
    private $imageName;

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
     * @param bool $isActive Is active
     *
     * @return $this
     */
    public function setActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Is active?
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->isActive;
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

    /**
     * Set request manager groups
     *
     * @param ArrayCollection|RequestManagerGroup[] $requestManagerGroups Request Manager Groups
     *
     * @return $this
     */
    public function setRequestManagerGroups(ArrayCollection $requestManagerGroups)
    {
        foreach ($requestManagerGroups as $requestManagerGroup) {
            $requestManagerGroup->setGroup($this);
        }
        $this->requestManagerGroups = $requestManagerGroups;

        return $this;
    }

    /**
     * Get request manager groups
     *
     * @return ArrayCollection|RequestManagerGroup[] Request Manager Groups
     */
    public function getRequestManagerGroups()
    {
        return $this->requestManagerGroups;
    }

    /*
     * @param File|UploadedFile $image Image
     *
     * @return Group
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName Image name
     *
     * @return Group
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }
}
