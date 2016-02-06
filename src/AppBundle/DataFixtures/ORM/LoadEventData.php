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
            ->setImageName('zaxid.jpg')
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
            ->setImageName('bring.jpg')
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
            ->setImageName('torvald.jpg')
            ->setSlug('concert-torvald')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('event-torvald', $event3);
        $manager->persist($event3);

        $event4 = (new Event())
            ->setName('Coldplay у Art-pub')
            ->setDescription('Концерт британського рок-гурту у місті Хмельницькому')
            ->setCountry('Україна')
            ->setCity('Хмельницький')
            ->setAddress('вул. Подільска 11')
            ->setBeginAt((new \DateTime())->modify('6 day'))
            ->setEndAt((new \DateTime())->modify('6 day 2 hour'))
            ->setImageName('group-img-1.jpg')
            ->setSlug('concert-coldplay-kmel')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('event-coldplay', $event4);
        $manager->persist($event4);

        $event5 = (new Event())
            ->setName('OneRepublic у Львові')
            ->setDescription('Концерт американського поп-рок гурт, який заснований у 2002 року в місті Колорадо-Спрінгзі.')
            ->setCountry('Україна')
            ->setCity('Львів')
            ->setAddress('вулиця Героїв Крут')
            ->setBeginAt((new \DateTime())->modify('2 day'))
            ->setEndAt((new \DateTime())->modify('2 day 4 hour'))
            ->setImageName('group-img-2.jpg')
            ->setSlug('concert-onerepublic-lvov')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('event-onerepublic', $event5);
        $manager->persist($event5);

        $event6 = (new Event())
            ->setName('Imagine Dragons у Мінську')
            ->setDescription('Imagine Dragons — американська інді-рок-гурт, утворений у 2008 році у Лас-Вегасі, штат Невада. Стали відомі після випуску їх дебютного студійного альбому Night Visions у вересні 2012 року. Американський журнал Billboard назвав їх найяскравішими новими зірками 2013, а журнал Rolling Stone назвали їх сингл «Radioactive» найбільшим рок-хітом року')
            ->setCountry('Білорусь')
            ->setCity('Мінськ')
            ->setAddress('вулиця Гарнізона 14')
            ->setBeginAt((new \DateTime())->modify('12 day'))
            ->setEndAt((new \DateTime())->modify('12 day 3 hour'))
            ->setImageName('group-img-3.jpg')
            ->setSlug('concert-imagine-dragons-minsk')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('event-dragon', $event6);
        $manager->persist($event6);

        $event7 = (new Event())
            ->setName('Somali Yacht Club у Art-pub')
            ->setDescription('Концерт українського психоделік рок-гурту у місті Хмельницькому')
            ->setCountry('Україна')
            ->setCity('Хмельницький')
            ->setAddress('вул. Подільска 11')
            ->setBeginAt((new \DateTime())->modify('1 day'))
            ->setEndAt((new \DateTime())->modify('1 day 5 hour'))
            ->setImageName('somali.jpg')
            ->setSlug('concert-somali-kmel')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('event-somali', $event7);
        $manager->persist($event7);

        $event8 = (new Event())
            ->setName('Five finger death punch у Києві')
            ->setDescription('«Five Finger Death Punch» (вимова: Файв-Фінґер-Дез-Панч) — американський гурт, що грає грув-метал. Виник 2005 року у Лас-Вегасі, Невада. Назва гурту означає «смертельний удар п\'ятьма пальцями» й походить із класичних фільмів про східні єдиноборства. Дебютний альбом «The Way of the Fist» було видано 2007 року, після чого гурт почав швидко здобувати популярність. Було продано більше 2,6 млн альбомів у США.')
            ->setCountry('Україна')
            ->setCity('Київ')
            ->setAddress('вулиця Зарічанська')
            ->setBeginAt((new \DateTime())->modify('4 day'))
            ->setEndAt((new \DateTime())->modify('4 day 5 hour'))
            ->setImageName('ffdp.jpg')
            ->setSlug('concert-ffdp-kiev')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('event-ffdp', $event8);
        $manager->persist($event8);

        $event9 = (new Event())
            ->setName('Red Hot Chili Peppers у Києві')
            ->setDescription('Red Hot Chili Peppers (часто используется аббревиатура RHCP; с англ. — «красные острые чилийские перцы») — американская рок-группа, образованная в 1983 году в Калифорнии вокалистом Энтони Кидисом, басистом Майклом Бэлзари (больше известным как Фли), гитаристом Хиллелом Словаком и барабанщиком Джеком Айронсом. Обладает 7 премиями «Грэмми». Во всём мире проданы более 80 миллионов копий их альбомов')
            ->setCountry('Україна')
            ->setCity('Київ')
            ->setAddress('вулиця Фрунзе 56')
            ->setBeginAt((new \DateTime())->modify('14 day'))
            ->setEndAt((new \DateTime())->modify('14 day 5 hour'))
            ->setImageName('rhcp.jpg')
            ->setSlug('concert-rchp-kiev')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('event-rhcp', $event9);
        $manager->persist($event9);

        $event10 = (new Event())
            ->setName('Anti-Flag у Тернополі')
            ->setDescription('Anti-Flag — американская панк-рок-группа из Питтсбурга, Пенсильвания. В состав группы входят вокалист и гитарист Джастин Сэйн (Justin Sane), барабанщик Пэт Тетик (Pat Thetic), которые основали группу; а также гитарист Крис Хед (Chris Head) и вокалист/бас-гитарист Крис № 2 (Chris Barker).')
            ->setCountry('Україна')
            ->setCity('Тернопіль')
            ->setAddress('вул. Залізняка')
            ->setBeginAt((new \DateTime())->modify('1 day'))
            ->setEndAt((new \DateTime())->modify('1 day 3 hour'))
            ->setImageName('flag.jpg')
            ->setSlug('concert-anti-flag-ternopil')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('event-anti-flag', $event10);
        $manager->persist($event10);

        $event11 = (new Event())
            ->setName('Anti-Flag у Тернополі')
            ->setDescription('Anti-Flag — американская панк-рок-группа из Питтсбурга, Пенсильвания. В состав группы входят вокалист и гитарист Джастин Сэйн (Justin Sane), барабанщик Пэт Тетик (Pat Thetic), которые основали группу; а также гитарист Крис Хед (Chris Head) и вокалист/бас-гитарист Крис № 2 (Chris Barker).')
            ->setCountry('Україна')
            ->setCity('Тернопіль')
            ->setAddress('вул. Залізняка')
            ->setBeginAt((new \DateTime())->modify('-1 day'))
            ->setEndAt((new \DateTime())->modify('-1 day 3 hour'))
            ->setImageName('flag.jpg')
            ->setSlug('concert-anti-flag-ternopil-old')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $manager->persist($event11);

        $event12 = (new Event())
            ->setName('Red Hot Chili Peppers у Києві')
            ->setDescription('Red Hot Chili Peppers (часто используется аббревиатура RHCP; с англ. — «красные острые чилийские перцы») — американская рок-группа, образованная в 1983 году в Калифорнии вокалистом Энтони Кидисом, басистом Майклом Бэлзари (больше известным как Фли), гитаристом Хиллелом Словаком и барабанщиком Джеком Айронсом. Обладает 7 премиями «Грэмми». Во всём мире проданы более 80 миллионов копий их альбомов')
            ->setCountry('Україна')
            ->setCity('Київ')
            ->setAddress('вулиця Фрунзе 56')
            ->setBeginAt((new \DateTime())->modify('-14 day'))
            ->setEndAt((new \DateTime())->modify('-14 day 5 hour'))
            ->setImageName('rhcp.jpg')
            ->setSlug('concert-rchp-kiev-old')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('event-rhcp', $event12);
        $manager->persist($event12);

        $event13 = (new Event())
            ->setName('Imagine Dragons у Мінську')
            ->setDescription('Imagine Dragons — американська інді-рок-гурт, утворений у 2008 році у Лас-Вегасі, штат Невада. Стали відомі після випуску їх дебютного студійного альбому Night Visions у вересні 2012 року. Американський журнал Billboard назвав їх найяскравішими новими зірками 2013, а журнал Rolling Stone назвали їх сингл «Radioactive» найбільшим рок-хітом року')
            ->setCountry('Білорусь')
            ->setCity('Мінськ')
            ->setAddress('вулиця Гарнізона 14')
            ->setBeginAt((new \DateTime())->modify('-12 day'))
            ->setEndAt((new \DateTime())->modify('-12 day 3 hour'))
            ->setImageName('group-img-3.jpg')
            ->setSlug('concert-imagine-dragons-minsk-old')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('event-dragon', $event13);
        $manager->persist($event13);

        $event14 = (new Event())
            ->setName('O.Torvald з концетром у Sentrum')
            ->setDescription('Київський концерт O.Torvald')
            ->setCountry('Україна')
            ->setCity('Київ')
            ->setAddress('провулок Перемоги 12')
            ->setBeginAt((new \DateTime())->modify('-4 day'))
            ->setEndAt((new \DateTime())->modify('-4 day 2 hour'))
            ->setDuration(3)
            ->setImageName('torvald.jpg')
            ->setSlug('concert-torvald-old')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('event-torvald', $event14);
        $manager->persist($event14);

        $event15 = (new Event())
            ->setName('Bring me the horizon у Києві')
            ->setDescription('Перший концерт Bring me the horizon в Україні')
            ->setCountry('Україна')
            ->setCity('Київ')
            ->setAddress('вулиця Чорновола')
            ->setBeginAt((new \DateTime())->modify('-6 day'))
            ->setEndAt((new \DateTime())->modify('-6 day 3 hour'))
            ->setDuration(3)
            ->setImageName('bring.jpg')
            ->setSlug('concert-bmth-old')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('event-bmth', $event15);
        $manager->persist($event15);

        $manager->flush();
    }
}
