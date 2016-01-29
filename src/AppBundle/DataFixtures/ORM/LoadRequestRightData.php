<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Group;
use AppBundle\Entity\RequestRight;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * LoadRequestRightData class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LoadRequestRightData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'AppBundle\DataFixtures\ORM\LoadGroupData',
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

        /** @var Group $groupEnterShikari */
        /** @var Group $groupBMTH */
        /** @var Group $groupJinjer */
        $groupEnterShikari = $this->getReference('group-enter-shikari');
        $groupBMTH         = $this->getReference('group-bmth');
        $groupJinjer       = $this->getReference('group-jinjer');

        $requestRight1 = (new RequestRight())
            ->setUser($userAdmin)
            ->setGroup($groupBMTH)
            ->setText('Вітаю, я адміністратор гурту Bring me the Horizon, телефон для зв"язку - 0974045670')
            ->setIsConfirm(true);
        $manager->persist($requestRight1);

        $requestRight2 = (new RequestRight())
            ->setUser($userAdmin)
            ->setGroup($groupEnterShikari)
            ->setText('Вітаю, я адміністратор гурту Enter Shikari, телефон для зв"язку - 0974045670')
            ->setIsConfirm(false);
        $manager->persist($requestRight2);

        $requestRight3 = (new RequestRight())
            ->setUser($userAdmin)
            ->setGroup($groupJinjer)
            ->setText('Вітаю, я адміністратор гурту Enter Shikari, телефон для зв"язку - 0974045670')
            ->setIsConfirm(true);
        $manager->persist($requestRight3);

        $manager->flush();
    }
}
