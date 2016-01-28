<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Event;
use AppBundle\Entity\User;
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
        /** @var User $userAdmin */
        $userAdmin = $this->getReference('user-admin');

        $event1 = (new Event())
            ->setName('Захід Фест')
            ->setDescription(<<<TEXT
Захід — український щорічний фестиваль сучасного мистецтва, що відбувається з 2009 року на Львівщині.
З 2011 року проходить біля села Родатичі Городоцького району.
TEXT
            )
            ->setCountry('Україна')
            ->setCity('Львів')
            ->setAddress('Львівська область, Городоцький район, село Родатичі')
            ->setBeginAt((new \DateTime())->modify('15 day'))
            ->setEndAt((new \DateTime())->modify('17 day'))
            ->setDuration(64)
            ->setSlug('zaxid')
            ->setActive(true)
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
            ->setBeginAt((new \DateTime())->modify('6 day'))
            ->setEndAt((new \DateTime())->modify('6 day 3 hour'))
            ->setDuration(3)
            ->setSlug('concert-bmth')
            ->setActive(true)
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
            ->setBeginAt((new \DateTime())->modify('4 day'))
            ->setEndAt((new \DateTime())->modify('4 day 2 hour'))
            ->setDuration(3)
            ->setSlug('concert-torvald')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('event-torvald', $event3);
        $manager->persist($event3);

        $manager->flush();
    }
}