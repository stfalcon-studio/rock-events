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
     * @var ArrayCollection|RequestManagerGroup[] $requestManagerGroups Request Manager Group
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RequestManagerGroup", mappedBy="requestManager")
     */
    private $requestManagerGroups;

    /**
     * @var string $surname Surname
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="100")
     * @Assert\Type(type="string")
     *
     * @Gedmo\Versioned
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
     *
     * @Gedmo\Versioned
     */
    private $name;

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
