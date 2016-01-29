<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Group;
use AppBundle\Entity\RequestManager;
use AppBundle\Entity\RequestManagerGroup;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * LoadRequestManagerGroupData class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LoadRequestManagerGroupData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'AppBundle\DataFixtures\ORM\LoadRequestManagerData',
            'AppBundle\DataFixtures\ORM\LoadGroupData',
        ];
    }

    public function load(ObjectManager $manager)
    {
        /** @var RequestManager $requestManager1 */
        /** @var RequestManager $requestManager2 */
        /** @var RequestManager $requestManager3 */
        $requestManager1 = $this->getReference('request-manager-1');
        $requestManager2 = $this->getReference('request-manager-2');
        $requestManager3 = $this->getReference('request-manager-3');

        /** @var Group $groupEnterShikari */
        /** @var Group $groupBMTH */
        /** @var Group $groupJinjer */
        $groupEnterShikari = $this->getReference('group-enter-shikari');
        $groupBMTH         = $this->getReference('group-bmth');
        $groupJinjer       = $this->getReference('group-jinjer');

        $requestManagerGroup1 = (new RequestManagerGroup())
            ->setRequestManager($requestManager1)
            ->setGroup($groupEnterShikari);
        $manager->persist($requestManagerGroup1);

        $requestManagerGroup2 = (new RequestManagerGroup())
            ->setRequestManager($requestManager1)
            ->setGroup($groupBMTH);
        $manager->persist($requestManagerGroup2);

        $requestManagerGroup3 = (new RequestManagerGroup())
            ->setRequestManager($requestManager1)
            ->setGroup($groupJinjer);
        $manager->persist($requestManagerGroup3);

        $requestManagerGroup4 = (new RequestManagerGroup())
            ->setRequestManager($requestManager2)
            ->setGroup($groupBMTH);
        $manager->persist($requestManagerGroup4);

        $requestManagerGroup5 = (new RequestManagerGroup())
            ->setRequestManager($requestManager3)
            ->setGroup($groupBMTH);
        $manager->persist($requestManagerGroup5);

        $manager->flush();
    }
}
