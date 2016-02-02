<?php

namespace AppBundle\Security\Provider;

use AppBundle\Entity\User;
use FOS\UserBundle\Model\UserManagerInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * OAuthUserProvider class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class OAuthUserProvider extends BaseClass
{
    /**
     * {@inheritDoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        $property = $this->getProperty($response);
        $username = $response->getUsername();

        //on connect - get the access token and the user ID
        $service = $response->getResourceOwner()->getName();

        $setter      = 'set'.ucfirst($service);
        $setterId    = $setter.'Id';
        $setterToken = $setter.'AccessToken';

        if (null !== $previousUser = $this->userManager->findUserBy([$property => $username])) {
            $previousUser->$setterId(null);
            $previousUser->$setterToken(null);
            $this->userManager->updateUser($previousUser);
        }

        $user->$setterId($username);
        $user->$setterToken($response->getAccessToken());

        $this->userManager->updateUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $username = $response->getUsername();
        $user     = $this->userManager->findUserBy([$this->getProperty($response) => $username]);
        if (null === $user) {
            $service     = $response->getResourceOwner()->getName();
            $setter      = 'set'.ucfirst($service);
            $setterId    = $setter.'Id';
            $setterToken = $setter.'AccessToken';
            $user        = (new User())
                ->$setterId($username)
                ->$setterToken($response->getAccessToken())
                ->setUsername($username)
                ->setEmail($username)
                ->setPassword($username)
                ->setEnabled(true);

            $this->userManager->updateUser($user);

            return $user;
        }

        $user = parent::loadUserByOAuthUserResponse($response);

        $serviceName = $response->getResourceOwner()->getName();
        $setter      = 'set'.ucfirst($serviceName).'AccessToken';

        $user->$setter($response->getAccessToken());

        return $user;
    }
}
