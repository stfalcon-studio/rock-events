<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DBAL\Types\RequestManagerStatusType;
use AppBundle\Entity\RequestManager;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * LoadRequestManagerData class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LoadRequestManagerData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'AppBundle\DataFixtures\ORM\LoadUserData',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var User $userAdmin
         */
        $userAdmin = $this->getReference('user-admin');

        $requestManager1 = (new RequestManager())
            ->setUser($userAdmin)
            ->setSurname('Іванов')
            ->setName('Іван')
            ->setPhone('0984534222')
            ->setStatus(RequestManagerStatusType::REQUEST_CONFIRM)
            ->setText('Вітаю, я адміністратор гурту Bring me the Horizon, телефон для зв"язку - 0974045670');
        $this->setReference('request-manager-1', $requestManager1);
        $manager->persist($requestManager1);

        $requestManager2 = (new RequestManager())
            ->setUser($userAdmin)
            ->setSurname('Іванов')
            ->setName('Іван')
            ->setPhone('0984534222')
            ->setStatus(RequestManagerStatusType::REQUEST_SEND)
            ->setText('Вітаю, я адміністратор гурту Enter Shikari, телефон для зв"язку - 0974045670');
        $this->setReference('request-manager-2', $requestManager2);
        $manager->persist($requestManager2);

        $requestManager3 = (new RequestManager())
            ->setUser($userAdmin)
            ->setSurname('Іванов')
            ->setName('Іван')
            ->setPhone('0984534222')
            ->setStatus(RequestManagerStatusType::REQUEST_REVIEW_MANAGER)
            ->setText('Вітаю, я адміністратор гурту Enter Shikari, телефон для зв"язку - 0974045670');
        $this->setReference('request-manager-3', $requestManager3);
        $manager->persist($requestManager3);

        $manager->flush();
    }
}
