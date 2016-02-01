<?php

namespace AppBundle\Form\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Group Entity
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class Group
{
    /**
     * @var string $name Name
     */
    private $name;

    /**
     * @var string $description Description
     */
    private $description;

    /**
     * @var int $foundedAt founded at
     */
    private $foundedAt;

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
     * @param int $foundedAt founded at
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
     * @return int Founded At
     */
    public function getFoundedAt()
    {
        return $this->foundedAt;
    }
}
