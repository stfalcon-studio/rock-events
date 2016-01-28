<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Group;
use AppBundle\Entity\ManagerGroup;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * LoadManagerGroupData
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LoadManagerGroupData extends AbstractFixture implements DependentFixtureInterface
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
        $user = $this->getReference('user-manager');


        /** @var Group $groupEnterShikari */
        /** @var Group $groupBMTH */
        /** @var Group $groupJinjer */
        $groupEnterShikari = $this->getReference('group-enter-shikari');
        $groupBMTH         = $this->getReference('group-bmth');
        $groupJinjer       = $this->getReference('group-jinjer');

        $managerGroup1 = (new ManagerGroup())
            ->setManager($user)
            ->setGroup($groupEnterShikari);
        $manager->persist($managerGroup1);

        $managerGroup2 = (new ManagerGroup())
            ->setManager($user)
            ->setGroup($groupBMTH);
        $manager->persist($managerGroup2);

        $managerGroup3 = (new ManagerGroup())
            ->setManager($user)
            ->setGroup($groupJinjer);
        $manager->persist($managerGroup3);

        $manager->flush();
    }
}