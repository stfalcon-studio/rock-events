<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Event;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * LoadEventData
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LoadEventData extends AbstractFixture implements DependentFixtureInterface
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

        $event1 = (new Event())
            ->setName('Захід Фест')
            ->setDescription('Захід — український щорічний фестиваль сучасного мистецтва, що відбувається з 2009 року на Львівщині. З 2011 року проходить біля села Родатичі Городоцького району.')
            ->setCountry('Україна')
            ->setCity('Львів')
            ->setAddress('Львівська область, Городоцький район, село Родатичі')
            ->setBeginAt(new \DateTime('2016-08-21 14:0:0'))
            ->setEndAt(new \DateTime('2016-08-23 23:55:0'))
            ->setDuration(64)
            ->setSlug('zaxid')
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('event-zaxid', $event1);
        $manager->persist($event1);

        $event2 = (new Event())
            ->setName('Bring me the horizon у Києві')
            ->setDescription('Перший концерт Bring me the horizon в Україні')
            ->setCountry('Україна')
            ->setCity('Київ')
            ->setAddress('вулиця Чорновола')
            ->setBeginAt(new \DateTime('2016-04-2 20:0:0'))
            ->setEndAt(new \DateTime('2016-04-2 23:0:0'))
            ->setDuration(3)
            ->setSlug('concert-bmth')
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('event-bmth', $event2);
        $manager->persist($event2);

        $event3 = (new Event())
            ->setName('O.Torvald з концетром у Sentrum')
            ->setDescription('Київський концерт O.Torvald')
            ->setCountry('Україна')
            ->setCity('Київ')
            ->setAddress('провулок Перемоги 12')
            ->setBeginAt(new \DateTime('2016-04-15 19:0:0'))
            ->setEndAt(new \DateTime('2016-04-15 22:0:0'))
            ->setDuration(3)
            ->setSlug('concert-torvald')
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('event-torvald', $event3);
        $manager->persist($event3);

        $manager->flush();
    }
}