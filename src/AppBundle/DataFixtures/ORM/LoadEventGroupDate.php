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
class LoadEventGroupDate extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'AppBundle\DataFixtures\ORM\LoadEventData',
            'AppBundle\DataFixtures\ORM\LoadGroupData'
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


         /** @var Group $groupEnterShikari */
         /** @var Group $groupBMTH */
         /** @var Group $groupJinjer */
        $groupEnterShikari = $this->getReference('group-enter-shikari');
        $groupBMTH         = $this->getReference('group-bmth');
        $groupJinjer       = $this->getReference('group-jinjer');

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

        $manager->flush();
    }
}