<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Ticket;
use AppBundle\Entity\Event;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * LoadTicketData
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LoadTicketData extends AbstractFixture implements DependentFixtureInterface
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
         /** @var Event $eventZaxid */
         /** @var Event $eventBMTH */
        $eventZaxid = $this->getReference('event-zaxid');
        $eventBMTH  = $this->getReference('event-bmth');

        $ticket1 = (new Ticket())
            ->setEvent($eventZaxid)
            ->setPrice(880)
            ->setLinkToBuyTicket('http://www.concert.ua/eventpage/zahidfest');
        $manager->persist($ticket1);

        $ticket2 = (new Ticket())
            ->setEvent($eventBMTH)
            ->setPrice(740)
            ->setLinkToBuyTicket('http://www.concert.ua/eventpage/theprodigy');
        $manager->persist($ticket2);

        $manager->flush();
    }
}
