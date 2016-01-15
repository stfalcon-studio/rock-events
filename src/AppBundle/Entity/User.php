<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User Entity
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int $id ID
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        // By default all users are admins
        $this->roles = ['ROLE_ADMIN'];
    }

    /**
     * Get expires at
     *
     * @return \DateTime Expires at
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Get credentials expire at
     *
     * @return \DateTime Credentials expire at
     */
    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }

}