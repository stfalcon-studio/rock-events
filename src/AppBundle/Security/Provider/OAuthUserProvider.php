<?php

namespace AppBundle\Security\Provider;

use AppBundle\Entity\User;
use FOS\UserBundle\Model\UserManagerInterface;
use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\VkontakteResourceOwner;
use HWI\Bundle\OAuthBundle\OAuth\ResourceOwnerInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * OAuthUserProvider class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class OAuthUserProvider extends BaseClass
{
    /**
     * @param User                  $user     User
     * @param UserResponseInterface $response User response interface
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        $username = $response->getUsername();
        $property = $this->getProperty($response);

        /** @var User $previousUser */
        $previousUser = $this->userManager->findUserBy([
            $property => $username,
        ]);

        $service = $response->getResourceOwner()->getName();
        switch ($service) {
            case 'vkontakte':
                if (null !== $previousUser) {
                    $previousUser->setVkId(null);
                    $previousUser->setVkAccessToken(null);
                }
                $user->setVkId($username);
                $user->setVkAccessToken($response->getAccessToken());
                $this->userManager->updateUser($previousUser);
                break;
            case 'facebook':
                if (null !== $previousUser) {
                    $previousUser->setFacebookId(null);
                    $previousUser->setFacebookAccessToken(null);
                }
                $user->setFacebookId($username);
                $user->setFacebookAccessToken($response->getAccessToken());
                $this->userManager->updateUser($previousUser);
                break;
            case 'google':
                if (null !== $previousUser) {
                    $previousUser->setGoogleId(null);
                    $previousUser->setGoogleAccessToken(null);
                }
                $user->setGoogleId($username);
                $user->setGoogleAccessToken($response->getAccessToken());
                $this->userManager->updateUser($previousUser);
                break;
        }

        $this->userManager->updateUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $username  = $response->getUsername();
        $user      = $this->userManager->findUserBy([
            $this->getProperty($response) => $username,
        ]);
        $userEmail = $this->userManager->findUserBy([
            'email' => $response->getEmail(),
        ]);

        if (null === $user && null === $userEmail) {
            /** @var User $user */
            $user = (new User())
                ->setUsername($username)
                ->setEmail($response->getEmail())
                ->setPassword($username)
                ->setFullName($response->getLastName().' '.$response->getFirstName())
                ->setEnabled(true);

            $service = $response->getResourceOwner()->getName();
            switch ($service) {
                case 'vkontakte':
                    $user->setVkId($username)
                         ->setVkAccessToken($response->getAccessToken());
                    break;
                case 'facebook':
                    $user->setFacebookId($username)
                         ->setFacebookAccessToken($response->getAccessToken());
                    break;
                case 'google':
                    $user->setGoogleId($username)
                         ->setGoogleAccessToken($response->getAccessToken());
                    break;
            }

            $this->userManager->updateUser($user);

            return $user;
        }

        /** @var User $user */
        $user = parent::loadUserByOAuthUserResponse($response);

        $serviceName = $response->getResourceOwner()->getName();
        switch ($serviceName) {
            case 'vkontakte':
                $user->setVkAccessToken($response->getAccessToken());
                break;
            case 'facebook':
                $user->setFacebookAccessToken($response->getAccessToken());
                break;
            case 'google':
                $user->setGoogleAccessToken($response->getAccessToken());
                break;
        }

        return $user;
    }
}
