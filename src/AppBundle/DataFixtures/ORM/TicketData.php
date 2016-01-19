<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Ticket;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * LoadTicketData
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class TicketData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'AppBundle\DataFixtures\ORM\LoadEventData'
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /**
         * var \AppBundle\Entity\Event $user
         */
        $user = $this->getReference('user-admin');

        /**
         * @var \AppBundle\Entity\Event $eventZaxid
         * @var \AppBundle\Entity\Event $eventBMTH
         */
        $eventZaxid = $this->getReference('event-zaxid');
        $eventBMTH  = $this->getReference('event-bmth');

        $ticket1 = (new Ticket())
            ->setEvent($eventZaxid)
            ->setUser($user)
            ->setPrice(880);
        $manager->persist($ticket1);

        $ticket2 = (new Ticket())
            ->setEvent($eventBMTH)
            ->setUser($user)
            ->setPrice(740);
        $manager->persist($ticket2);

        $manager->flush();
    }
}