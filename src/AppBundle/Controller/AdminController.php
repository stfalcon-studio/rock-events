<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

/**
 * Class AdminController
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class AdminController extends BaseAdminController
{

    /**
     * {@inheritdoc}
     *
     * @param User $user
     */
    public function prePersistUsersEntity(User $user)
    {
        $this->container->get('fos_user.user_manager')->updateUser($user, false);
    }

    /**
     * {@inheritdoc}
     *
     * @param User $user
     */
    public function preUpdateUsersEntity(User $user)
    {
        $this->container->get('fos_user.user_manager')->updateUser($user, false);
    }

    /**
     * {@inheritdoc}
     *
     * @param $user
     */
    public function preUpdateUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

    /**
     * {@inheritdoc}
     *
     * @return User
     */
    public function createNewUserEntity()
    {
        return new User(array('ROLE_USER'), true);
    }
}