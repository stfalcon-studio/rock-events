<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Event;
use AppBundle\Entity\Group;
use AppBundle\Entity\EventGroup;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * LoadEventGroupData
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LoadEventGroupData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'AppBundle\DataFixtures\ORM\LoadEventData',
            'AppBundle\DataFixtures\ORM\LoadGroupData',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var Event $eventZaxid */
        /** @var Event $eventBMTH */
        /** @var Event $eventTorvald */
        /** @var Event $eventColdplay */
        /** @var Event $eventOneRepublic */
        /** @var Event $eventDragon */
        /** @var Event $eventSomali */
        /** @var Event $eventFFDP */
        /** @var Event $eventRHCP */
        /** @var Event $eventAntiFlag */
        /** @var Event $eventAntiFlagOld */
        /** @var Event $eventRHCPOld */
        /** @var Event $eventDragonOld */
        /** @var Event $eventTorvaldOld */
        /** @var Event $eventBMTHOld */
        $eventZaxid       = $this->getReference('event-zaxid');
        $eventBMTH        = $this->getReference('event-bmth');
        $eventTorvald     = $this->getReference('event-torvald');
        $eventColdplay    = $this->getReference('event-coldplay');
        $eventOneRepublic = $this->getReference('event-onerepublic');
        $eventDragon      = $this->getReference('event-dragon');
        $eventSomali      = $this->getReference('event-somali');
        $eventFFDP        = $this->getReference('event-ffdp');
        $eventRHCP        = $this->getReference('event-rhcp');
        $eventAntiFlag    = $this->getReference('event-anti-flag');
        $eventAntiFlagOld = $this->getReference('event-anti-flag-old');
        $eventRHCPOld     = $this->getReference('event-rhcp-old');
        $eventDragonOld   = $this->getReference('event-dragon-old');
        $eventTorvaldOld  = $this->getReference('event-torvald-old');
        $eventBMTHOld     = $this->getReference('event-bmth-old');

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

        $eventGroup1 = (new EventGroup())
            ->setEvent($eventZaxid)
            ->setGroup($groupEnterShikari);
        $manager->persist($eventGroup1);

        $eventGroup2 = (new EventGroup())
            ->setEvent($eventZaxid)
            ->setGroup($groupJinjer);
        $manager->persist($eventGroup2);

        $eventGroup3 = (new EventGroup())
            ->setEvent($eventBMTH)
            ->setGroup($groupBMTH);
        $manager->persist($eventGroup3);

        $eventGroup4 = (new EventGroup())
            ->setEvent($eventTorvald)
            ->setGroup($groupTorvald);
        $manager->persist($eventGroup4);

        $eventGroup5 = (new EventGroup())
            ->setEvent($eventTorvaldOld)
            ->setGroup($groupTorvald);
        $manager->persist($eventGroup5);

        $eventGroup6 = (new EventGroup())
            ->setEvent($eventColdplay)
            ->setGroup($groupColdplay);
        $manager->persist($eventGroup6);

        $eventGroup7 = (new EventGroup())
            ->setEvent($eventOneRepublic)
            ->setGroup($groupOneRepublic);
        $manager->persist($eventGroup7);

        $eventGroup8 = (new EventGroup())
            ->setEvent($eventDragon)
            ->setGroup($groupDragon);
        $manager->persist($eventGroup8);

        $eventGroup9 = (new EventGroup())
            ->setEvent($eventDragonOld)
            ->setGroup($groupDragon);
        $manager->persist($eventGroup9);

        $eventGroup10 = (new EventGroup())
            ->setEvent($eventSomali)
            ->setGroup($groupSomali);
        $manager->persist($eventGroup10);

        $eventGroup11 = (new EventGroup())
            ->setEvent($eventFFDP)
            ->setGroup($groupFFDP);
        $manager->persist($eventGroup11);

        $eventGroup12 = (new EventGroup())
            ->setEvent($eventRHCP)
            ->setGroup($groupRHCP);
        $manager->persist($eventGroup12);

        $eventGroup13 = (new EventGroup())
            ->setEvent($eventRHCPOld)
            ->setGroup($groupRHCP);
        $manager->persist($eventGroup13);

        $eventGroup14 = (new EventGroup())
            ->setEvent($eventAntiFlag)
            ->setGroup($groupAntiFlag);
        $manager->persist($eventGroup14);

        $eventGroup15 = (new EventGroup())
            ->setEvent($eventAntiFlagOld)
            ->setGroup($groupAntiFlag);
        $manager->persist($eventGroup15);

        $eventGroup16 = (new EventGroup())
            ->setEvent($eventBMTHOld)
            ->setGroup($groupBMTH);
        $manager->persist($eventGroup16);

        $manager->flush();
    }
}
