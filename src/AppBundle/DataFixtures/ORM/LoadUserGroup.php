<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\UserGroup;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserGroup extends AbstractFixture implements DependentFixtureInterface
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
         * @var \AppBundle\Entity\User $user
         */
        $user = $this->getReference('user-admin');

        /**
         * @var \AppBundle\Entity\Group $groupEnterShikari
         * @var \AppBundle\Entity\Group $groupBMTH
         * @var \AppBundle\Entity\Group $groupJinjer
         */
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