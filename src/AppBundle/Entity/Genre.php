<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Genre Entity
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @ORM\Table(name="genres")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GenreRepository")
 */
class Genre
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
     *
     * @var ArrayCollection|UserGenre[] $usersGenre Users Genres
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserGenre", mappedBy="genre")
     */
    private $usersGenres;

    /**
     * @var User $user User created by
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="genreCreatedBy")
     * @ORM\JoinColumn(nullable=true)
     */
    private $createdBy;

    /**
     * @var User $user User updated by
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="genreUpdatedBy")
     * @ORM\JoinColumn(nullable=true)
     */
    private $updatedBy;

    /**
     * @var string $name Name
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="100")
     * @Assert\Type(type="string")
     */
    private $name;

    /**
     * Get id
     *
     * @return integer
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
     * Get created by
     *
     * @return User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set created by
     *
     * @param User $createdBy created by
     *
     * @return Genre
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get updated by
     *
     * @return User
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set updated by
     *
     * @param User $updatedBy updated by
     *
     * @return Genre
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get users genres
     *
     * @return UserGenre[]|ArrayCollection Users Genres
     */
    public function getUsersGenres()
    {
        return $this->usersGenres;
    }

}
