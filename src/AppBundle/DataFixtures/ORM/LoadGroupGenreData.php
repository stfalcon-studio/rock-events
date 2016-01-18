<?php

namespace AppBundle\DataFixtures\ORM;

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
            'AppBundle\DataFixtures\ORM\LoadGenreData'
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var \AppBundle\Entity\Group $groupEnterShikari
         * @var \AppBundle\Entity\Group $groupBMTH
         * @var \AppBundle\Entity\Group $groupJinjer
         */
        $groupEnterShikari = $this->getReference('group-enter-shikari');
        $groupBMTH         = $this->getReference('group-bmth');
        $groupJinjer       = $this->getReference('group-jinjer');

        /**
         * @var \AppBundle\Entity\Genre $postPunk
         * @var \AppBundle\Entity\Genre $metalcore
         * @var \AppBundle\Entity\Genre $alternative
         */
        $postPunk    = $this->getReference('genre-post-punk');
        $metalcore   = $this->getReference('genre-metalcore');
        $alternative = $this->getReference('genre-alternative');

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

        $manager->flush();
    }
}