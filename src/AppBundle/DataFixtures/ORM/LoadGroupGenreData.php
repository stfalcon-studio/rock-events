<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Genre;
use AppBundle\Entity\Group;
use AppBundle\Entity\GroupGenre;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * LoadGroupGenreData
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LoadGroupGenreData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'AppBundle\DataFixtures\ORM\LoadGroupData',
            'AppBundle\DataFixtures\ORM\LoadGenreData',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var Group $groupEnterShikari */
        /** @var Group $groupBMTH */
        /** @var Group $groupJinjer */
        /** @var Group $groupAntiFlag */
        /** @var Group $groupRHCP */
        /** @var Group $groupFFDP */
        /** @var Group $groupColdplay */
        /** @var Group $groupOneRepublic */
        /** @var Group $groupDragon */
        /** @var Group $groupTorvald */
        /** @var Group $groupSomali */
        $groupEnterShikari = $this->getReference('group-enter-shikari');
        $groupBMTH         = $this->getReference('group-bmth');
        $groupJinjer       = $this->getReference('group-jinjer');
        $groupAntiFlag     = $this->getReference('group-anti-flag');
        $groupRHCP         = $this->getReference('group-rhcp');
        $groupFFDP         = $this->getReference('group-ffdp');
        $groupColdplay     = $this->getReference('group-coldplay');
        $groupOneRepublic  = $this->getReference('group-onerepublic');
        $groupDragon       = $this->getReference('group-gragon');
        $groupTorvald      = $this->getReference('group-torvald');
        $groupSomali       = $this->getReference('group-somali');

        /** @var Genre $postPunk */
        /** @var Genre $metalcore */
        /** @var Genre $alternative */
        /** @var Genre $indi */
        /** @var Genre $psychedelic */
        /** @var Genre $punk */
        $postPunk    = $this->getReference('genre-post-punk');
        $metalcore   = $this->getReference('genre-metalcore');
        $alternative = $this->getReference('genre-alternative');
        $indi        = $this->getReference('genre-indi');
        $psychedelic = $this->getReference('genre-psychedelic');
        $punk        = $this->getReference('genre-punk');

        $groupGenre1 = (new GroupGenre())
            ->setGroup($groupEnterShikari)
            ->setGenre($postPunk);
        $manager->persist($groupGenre1);

        $groupGenre2 = (new GroupGenre())
            ->setGroup($groupBMTH)
            ->setGenre($metalcore);
        $manager->persist($groupGenre2);

        $groupGenre3 = (new GroupGenre())
            ->setGroup($groupBMTH)
            ->setGenre($alternative);
        $manager->persist($groupGenre3);

        $groupGenre4 = (new GroupGenre())
            ->setGroup($groupJinjer)
            ->setGenre($metalcore);
        $manager->persist($groupGenre4);

        $groupGenre5 = (new GroupGenre())
            ->setGroup($groupAntiFlag)
            ->setGenre($alternative);
        $manager->persist($groupGenre5);

        $groupGenre6 = (new GroupGenre())
            ->setGroup($groupAntiFlag)
            ->setGenre($punk);
        $manager->persist($groupGenre6);

        $groupGenre7 = (new GroupGenre())
            ->setGroup($groupRHCP)
            ->setGenre($alternative);
        $manager->persist($groupGenre7);

        $groupGenre8 = (new GroupGenre())
            ->setGroup($groupFFDP)
            ->setGenre($metalcore);
        $manager->persist($groupGenre8);

        $groupGenre9 = (new GroupGenre())
            ->setGroup($groupColdplay)
            ->setGenre($indi);
        $manager->persist($groupGenre9);

        $groupGenre10 = (new GroupGenre())
            ->setGroup($groupColdplay)
            ->setGenre($alternative);
        $manager->persist($groupGenre10);

        $groupGenre11 = (new GroupGenre())
            ->setGroup($groupOneRepublic)
            ->setGenre($indi);
        $manager->persist($groupGenre11);

        $groupGenre12 = (new GroupGenre())
            ->setGroup($groupDragon)
            ->setGenre($indi);
        $manager->persist($groupGenre12);

        $groupGenre13 = (new GroupGenre())
            ->setGroup($groupTorvald)
            ->setGenre($alternative);
        $manager->persist($groupGenre13);

        $groupGenre14 = (new GroupGenre())
            ->setGroup($groupTorvald)
            ->setGenre($punk);
        $manager->persist($groupGenre14);

        $groupGenre15 = (new GroupGenre())
            ->setGroup($groupSomali)
            ->setGenre($psychedelic);
        $manager->persist($groupGenre15);

        $manager->flush();
    }
}
