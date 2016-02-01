<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use AppBundle\DBAL\Types\RequestManagerStatusType;

/**
 * Request Right Entity
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @ORM\Table(name="request_managers")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RequestManagerRepository")
 *
 * @Gedmo\Loggable
 */
class RequestManager
{
    use TimestampableEntity, BlameableEntityTrait;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="requestManagers")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     *
     * @Assert\NotBlank()
     *
     * @Gedmo\Versioned
     */
    private $user;

    /**
     * @var ArrayCollection|RequestManagerGroup[] $requestManagerGroups Request Manager Group
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RequestManagerGroup", mappedBy="requestManager")
     */
    private $requestManagerGroups;

    /**
     * @var string $fullName Full name
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="5", max="100")
     * @Assert\Type(type="string")
     *
     * @Gedmo\Versioned
     */
    private $fullName;

    /**
     * @var string $phone Phone
     *
     * @ORM\Column(type="string", length=50, nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="5")
     *
     * @Gedmo\Versioned
     */
    private $phone;

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
     * @var RequestManagerStatusType $status Status
     *
     * @ORM\Column(name="status", type="RequestManagerStatusType", nullable=true)
     *
     * @Gedmo\Versioned
     */
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
     * @return RequestManager
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
     * Set status
     *
     * @param RequestManagerStatusType $status Request manager status type
     *
     * @return RequestManager
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return RequestManagerStatusType Request manager status type
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param User $user User
     *
     * @return RequestManager
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
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
            $requestManagerGroup->setRequestManager($this);
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
}
