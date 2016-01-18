<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Genre;
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
         * @var \AppBundle\Entity\User $userAdmin
         */
        $userAdmin = $this->getReference('user-admin');

        $genre1 = (new Genre())
            ->setName('Пост-панк')
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $manager->persist($genre1);

        $genre2 = (new Genre())
            ->setName('Металкор')
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $manager->persist($genre2);

        $genre3 = (new Genre())
            ->setName('Психоделік')
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $manager->persist($genre3);

        $genre4 = (new Genre())
            ->setName('Альтернатива')
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $manager->persist($genre4);

        $genre5 = (new Genre())
            ->setName('Інді')
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $manager->persist($genre5);

        $manager->flush();
    }
}