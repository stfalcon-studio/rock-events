<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Group;
use AppBundle\Entity\User;
use AppBundle\Entity\UserGroup;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserGroupData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'AppBundle\DataFixtures\ORM\LoadGroupData'
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var User $user
         */
        $user = $this->getReference('user-admin');


         /** @var Group $groupEnterShikari */
         /** @var Group $groupBMTH */
         /** @var Group $groupJinjer */
        $groupEnterShikari = $this->getReference('group-enter-shikari');
        $groupBMTH         = $this->getReference('group-bmth');
        $groupJinjer       = $this->getReference('group-jinjer');

        $userGroup1 = (new UserGroup())
            ->setUser($user)
            ->setGroup($groupEnterShikari);
        $manager->persist($userGroup1);

        $userGroup2 = (new UserGroup())
            ->setUser($user)
            ->setGroup($groupBMTH);
        $manager->persist($userGroup2);

        $userGroup3 = (new UserGroup())
            ->setUser($user)
            ->setGroup($groupJinjer);
        $manager->persist($userGroup3);

        $manager->flush();
    }
}
