<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Group Genre Entity
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @ORM\Table(name="groups_to_genres")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupGenreRepository")
 *
 * @Gedmo\Loggable
 */
class GroupGenre
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
     * @var Group $group Group
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Group", inversedBy="groupGenres")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     *
     * @Assert\NotBlank()
     *
     * @Gedmo\Versioned
     */
    private $group;

    /**
     * @var Genre $genre Genre
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Genre", inversedBy="groupGenres")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     *
     * @Assert\NotBlank()
     *
     * @Gedmo\Versioned
     */
    private $genre;

    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        $result = 'New GroupGenre';

        if (null !== $this->group && null !== $this->genre) {
            $result = $this->group->getName().' - '.$this->genre->getName();
        }

        return $result;
    }

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
     * Set group
     *
     * @param Group $group Group
     *
     * @return GroupGenre
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

    /**
     * Set genre
     *
     * @param Genre $genre Genre
     *
     * @return GroupGenre
     */
    public function setGenre(Genre $genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return Genre
     */
    public function getGenre()
    {
        return $this->genre;
    }
}
