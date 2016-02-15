<?php

namespace AppBundle\Form\Entity;

use AppBundle\DBAL\Types\RequestManagerStatusType;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Group as OriginalGroup;

/**
 * RequestManager class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class RequestManager
{
    /** @var int $id ID */
    private $id;

    /** @var string $surname Surname */
    private $fullName;

    /** @var string $phone Phone */
    private $phone;

    /** @var string $text Text */
    private $text;

    /** @var ArrayCollection|OriginalGroup[] $groups Groups */
    private $groups;

    /** @var RequestManagerStatusType $status Status */
    protected $status = RequestManagerStatusType::SENT;

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
     * Set full name
     *
     * @param string $fullName Full name
     *
     * @return $this
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get full name
     *
     * @return string Full Name
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
     * @return $this
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
     * @return $this
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
     * @return $this
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

        return $this;
    }

    /**
     * Remove group
     *
     * @param Group $group
     *
     * @return $this
     */
    public function removeGroups(Group $group)
    {
        $this->groups->remove($group);

        return $this;
    }
}
