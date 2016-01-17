<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * LoadUserData
 *
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class LoadUserData extends AbstractFixture
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // Admin user
        $adminUser = (new User())
            ->setUsername('admin')
            ->setEnabled(true)
            ->setEmail('admin@stfalcon.com')
            ->setPlainPassword('qwerty');
        $this->setReference('user-admin', $adminUser);
        $manager->persist($adminUser);

        // Parser user
        $parserUser = (new User())
            ->setUsername('user')
            ->setEnabled(true)
            ->setEmail('user@stfalcon.com')
            ->setPlainPassword('qwerty');
        $this->setReference('user-user', $parserUser);
        $manager->persist($parserUser);

        $manager->flush();
    }
}
