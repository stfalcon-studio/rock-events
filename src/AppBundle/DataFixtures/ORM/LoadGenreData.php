<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Genre;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * LoadGenreData
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LoadGenreData extends AbstractFixture implements DependentFixtureInterface
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

        $genre1 = (new Genre())
            ->setName('Пост-панк')
            ->setSlug('post-punk')
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('genre-post-punk', $genre1);
        $manager->persist($genre1);

        $genre2 = (new Genre())
            ->setName('Металкор')
            ->setSlug('metalcore')
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('genre-metalcore', $genre2);
        $manager->persist($genre2);

        $genre3 = (new Genre())
            ->setName('Психоделік')
            ->setSlug('psychedelic')
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('genre-psychedelic', $genre3);
        $manager->persist($genre3);

        $genre4 = (new Genre())
            ->setName('Альтернатива')
            ->setSlug('alternative')
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('genre-alternative', $genre4);
        $manager->persist($genre4);

        $genre5 = (new Genre())
            ->setName('Інді')
            ->setSlug('indi')
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('genre-indi', $genre5);
        $manager->persist($genre5);

        $manager->flush();
    }
}