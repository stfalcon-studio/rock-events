<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * RequestManagerGroup class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 *
 * @ORM\Table(name="request_managers_to_groups")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RequestManagerGroupRepository")
 *
 * @Gedmo\Loggable
 */
class RequestManagerGroup
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
     * @var RequestManager $requestManger RequestManager
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\RequestManager", inversedBy="requestManagerGroups")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     *
     * @Assert\NotBlank()
     *
     * @Gedmo\Versioned
     */
    private $requestManager;

    /**
     * @var Group $group Groups
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Group", inversedBy="requestManagerGroups")
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set request manger
     *
     * @param RequestManager $requestManager Request manager
     *
     * @return RequestManagerGroup
     */
    public function setRequestManager(RequestManager $requestManager)
    {
        $this->requestManager = $requestManager;

        return $this;
    }

    /**
     * Get request manger
     *
     * @return RequestManager
     */
    public function getRequestManager()
    {
        return $this->requestManager;
    }

    /**
     * Set group
     *
     * @param Group $group Group
     *
     * @return RequestManagerGroup
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
