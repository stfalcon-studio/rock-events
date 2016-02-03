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
        /** @var Group $groupSomali  */
        /** @var Group $groupKarna */
        $groupEnterShikari = $this->getReference('group-enter-shikari');
        $groupBMTH         = $this->getReference('group-bmth');
        $groupJinjer       = $this->getReference('group-jinjer');
        $groupSomali       = $this->getReference('group-somali');
        $groupKarna        = $this->getReference('group-karna');

        /** @var Genre $postPunk */
        /** @var Genre $metalcore */
        /** @var Genre $alternative */
        /** @var Genre $psyhedelic */
        $postPunk    = $this->getReference('genre-post-punk');
        $metalcore   = $this->getReference('genre-metalcore');
        $alternative = $this->getReference('genre-alternative');
        $psyhedelic  = $this->getReference('genre-psychedelic');

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
            ->setGroup($groupSomali)
            ->setGenre($psyhedelic);
        $manager->persist($groupGenre5);

        $groupGenre6 = (new GroupGenre())
            ->setGroup($groupKarna)
            ->setGenre($alternative);
        $manager->persist($groupGenre6);

        $groupGenre7 = (new GroupGenre())
            ->setGroup($groupSomali)
            ->setGenre($alternative);
        $manager->persist($groupGenre7);

        $manager->flush();
    }
}
