<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Request Right Entity
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @ORM\Table(name="request_right")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RequestRightRepository")
 *
 * @Gedmo\Loggable
 */
class RequestRight
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="requestRights")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     *
     * @Gedmo\Versioned
     */
    private $user;

    /**
     * @var Group $group Group
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Group", inversedBy="requestRights")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     *
     * @Gedmo\Versioned
     */
    private $group;

    /**
     * @var string $text Text
     *
     * @ORM\Column(type="text", nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="2")
     * @Assert\Type(type="string")
     *
     * @Gedmo\Versioned
     */
    private $text;

    /**
     * @var bool $isConfirm Is confirm?
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isConfirm = false;

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
     * Set user
     *
     * @param User $user User
     *
     * @return RequestRight
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set group
     *
     * @param Group $group Group
     *
     * @return RequestRight
     */
    public function setGroup(Group $group = null)
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

    /**
     * Set text
     *
     * @param string $text
     *
     * @return RequestRight
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set isConfirm
     *
     * @param bool $isConfirm
     *
     * @return RequestRight
     */
    public function setIsConfirm($isConfirm)
    {
        $this->isConfirm = $isConfirm;

        return $this;
    }

    /**
     * Get Is Confirm?
     *
     * @return bool
     */
    public function IsConfirm()
    {
        return $this->isConfirm;
    }
}
