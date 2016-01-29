<?php

namespace AppBundle\Form\Entity;

use AppBundle\DBAL\Types\RequestManagerStatusType;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Group;

/**
 * RequestManager class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class RequestManager
{
    /** @var int $id ID */
    private $id;

    /** @var string $surname Surname */
    private $surname;

    /** @var string $name Name */
    private $name;

    /** @var string $phone Phone */
    private $phone;

    /** @var string $text Text */
    private $text;

    /** @var ArrayCollection|Group[] $groups Groups */
    private $groups;

    /** @var RequestManagerStatusType $status Status */
    protected $status = RequestManagerStatusType::SENDED;

    /**
     * Get ID
     *
     * @return int ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set surname
     *
     * @param string $surname Surname
     *
     * @return RequestManager
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
     * @return RequestManager
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
     * Set phone
     *
     * @param string $phone Phone
     *
     * @return RequestManager
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
     * Set text
     *
     * @param string $text Text
     *
     * @return RequestManager
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string Text
     */
    public function getText()
    {
        return $this->text;
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
