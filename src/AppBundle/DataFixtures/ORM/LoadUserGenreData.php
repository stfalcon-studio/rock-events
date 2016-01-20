<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Genre;
use AppBundle\Entity\User;
use AppBundle\Entity\UserGenre;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * LoadTtData
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LoadUserGenreData extends AbstractFixture implements DependentFixtureInterface
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
        /** @var User $user */
        $user = $this->getReference('user-admin');


         /** @var Genre $postPunk */
         /** @var Genre $metalcore */
         /** @var Genre $alternative */
        $postPunk    = $this->getReference('genre-post-punk');
        $metalcore   = $this->getReference('genre-metalcore');
        $alternative = $this->getReference('genre-alternative');

        $userGenre1 = (new UserGenre())
            ->setUser($user)
            ->setGenre($postPunk);
        $manager->persist($userGenre1);

        $userGenre2 = (new UserGenre())
            ->setUser($user)
            ->setGenre($metalcore);
        $manager->persist($userGenre2);

        $userGenre3 = (new UserGenre())
            ->setUser($user)
            ->setGenre($alternative);
        $manager->persist($userGenre3);

        $manager->flush();
    }
}