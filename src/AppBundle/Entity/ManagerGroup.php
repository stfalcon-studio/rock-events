<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ManagerGroup Entity
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @ORM\Table(name="managers_to_groups")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ManagerGroupRepository")
 *
 * @Gedmo\Loggable
 */
class ManagerGroup
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
     * @var User $user User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="managerGroups")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     *
     * @Assert\NotBlank()
     *
     * @Gedmo\Versioned
     */
    private $manager;

    /**
     * @var Group $group Group
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Group", inversedBy="managerGroups")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     *
     * @Assert\NotBlank()
     *
     * @Gedmo\Versioned
     */
    private $group;

    /**
     * Get ID
     *
     * @return int $id ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set manager
     *
     * @param User $manager User
     *
     * @return ManagerGroup
     */
    public function setManager(User $manager)
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * Get manager
     *
     * @return User
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Set group
     *
     * @param Group $group Group
     *
     * @return ManagerGroup
     */
    public function setGroup(Group $group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return Group
     */
    public function getGroup()
    {
        return $this->group;
    }
}