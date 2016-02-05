<?php

namespace AppBundle\Form\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Group Entity
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @Vich\Uploadable
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
     * @Vich\UploadableField(mapping="group_image", fileNameProperty="imageName")
     *
     * @var File $imageFile Image File
     */
    private $imageFile;

    /**
     * @var string $imageName Image name
     */
    private $imageName;

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
    /*
     * @param File|UploadedFile $image Image
     *
     * @return Group
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

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
