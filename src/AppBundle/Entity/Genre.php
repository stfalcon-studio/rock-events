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
 * Genre Entity
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 *
 * @ORM\Table(name="genres")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GenreRepository")
 *
 * @Gedmo\Loggable
 *
 * @Vich\Uploadable
 */
class Genre
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
     *
     * @var ArrayCollection|UserGenre[] $userGenre User Genres
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserGenre", mappedBy="genre")
     */
    private $userGenres;

    /**
     *
     * @var ArrayCollection|GroupGenre[] $groupGenres Group Genres
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\GroupGenre", mappedBy="genre")
     */
    private $groupGenres;

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
     * @Vich\UploadableField(mapping="genre_image", fileNameProperty="imageName", nullable=true)
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
        $result = 'New Genre';

        if (null !== $this->getName()) {
            $result = $this->getName();
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
     * @return Genre
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
     * Set group genres
     *
     * @param ArrayCollection|GroupGenre[] $groupGenres Group Genres
     *
     * @return $this
     */
    public function setGroupGenres(ArrayCollection $groupGenres)
    {
        foreach ($groupGenres as $groupGenre) {
            $groupGenre->setGenre($this);
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
     * Set user genres
     *
     * @param ArrayCollection|UserGenre[] $userGenres User Genres
     *
     * @return $this
     */
    public function setUserGenres(ArrayCollection $userGenres)
    {
        foreach ($userGenres as $userGenre) {
            $userGenre->setGenre($this);
        }
        $this->userGenres = $userGenres;

        return $this;
    }

    /**
     * Get user genres
     *
     * @return ArrayCollection|UserGenre[] User Genres
     */
    public function getUserGenres()
    {
        return $this->userGenres;
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
     * Set is Active
     *
     * @param bool $isActive is Active
     *
     * @return $this
     */
    public function setActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
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
