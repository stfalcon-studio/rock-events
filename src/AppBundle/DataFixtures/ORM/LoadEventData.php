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
     * @var string $imageFixturesDirectory Image fixtures directory
     */
    private $imageFixturesDirectory = '';

    /** @var string $imageWebDirectory Image Web directory */
    private $imageWebDirectory = __DIR__.'/../../../../web/images/events';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->imageFixturesDirectory = __DIR__.'/../../Resources/fixtures/images/events';
    }

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

        $this->prepareDirectories();
        $this->prepareImages();

        $event1 = (new Event())
            ->setName('Захід Фест')
            ->setDescription(
<<<HTML
<p>
Захід &mdash; український щорічний фестиваль сучасного мистецтва, що відбувається з 2009 року на Львівщині. З 2011 року проходить біля села Родатичі Городоцького району.
</p>
<p>
Напрямки музики: рок та етно та інші. З 2012 року у фестивалі регулярно беруть участь іноземні виконавці.
</p>
<p>
2009 року він відбувся у Звенигороді, 2010 &mdash; у Старосільському замку (з 21 по 23 серпня), а з 2011 року &mdash; на базі відпочинку &laquo;Сонячна долина&raquo; у с. Родатичах за 40 км від Львова, що було пов&#39;язано з очікуванням більшої кількості відвідувачів порівняно з попередніми роками. З 2014 року проводиться на території відпочинкового комплексу &quot;Чарівна долина&quot;
</p>
<p>
Мета фестивалю:</p>
<p>
Популяризація української культури.<br />Популяризація серед молоді активного відпочинку та розвиток фестивального руху в Україні.<br />Основною відмінністю від всіх інших фестивалів є те, що фестиваль &laquo;Захід&raquo; проводиться без підтримки спонсорів та політичних, чи будь-яких організацій. Організаторами фестивалю є група молодих ініціативних людей, головний організатор та засновник &mdash; Яків Матвійчук.
</p>
<p>
<img alt="" src="/images/events/zaxid1.jpg" style="height:250px; width:375px" />
<img alt="" src="/images/events/zaxid2.jpg" style="height:250px; width:375px" />
<img alt="" src="/images/events/zaxid3.jpg" style="height:250px; width:375px" />
<img alt="" src="/images/events/zaxid4.jpg" style="height:250px; width:375px" />
</p>
HTML
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
            ->setDescription(
<<<HTML
<p>
Альтернативники з Шеффілда Bring Me The Horizon їдуть до Києва!<br />&nbsp;<br />4 грудня легендарна група Bring Me The Horizon вперше відвідає столицю України! Концерт відгримить в Палаці Спорту. І знаєте, немає ніяких сумнівів - буде аншлаг!<br />&nbsp;<br />Цього року Bring Me The Horizon стали кращою британською групою за версією Kerrang Awards, обігнавши таких монстрів, як Muse, Enter Shikari, You me at Six і Architects. Бенд також отримав нагороду в тій же номінації на Metal Hammer Golden Gods Awards 2015.<br />&nbsp;<br />Тепер, пройшовши шлях від деткора до металкор - команда впевнено завойовує серця меломанів по всьому світу! Міжнародну популярність британці знайшли після виходу платівки &laquo;Sempiternal&raquo;, що стала платиновою.
</p>
<p>
У грудня 2014 Bring Me The Horizon відіграли грандіозний концерт на заповненому стадіоні Wembly. Що говорити, для BMTH це стало воістину знаковою подією! &quot;А вже на 11 вересня 2015 року біля музикантів запланований вихід п&#39;ятого альбому That&#39;s the Spirit<br />&nbsp;&nbsp;<br />Рок-журнал Kerrang! вважає їх кращою британською групою 2015 року, а організатор фестивалів Reading і Leeds впевнений, що через пару років вони стануть хедлайнерами! Ти ж не пропустиш такий концерт, вірно?<br />&nbsp;<br />До зустрічі на концерті в Києві! Буде неймовірно круто!
</p>
<p>
&nbsp;<img alt="" src="/images/events/bring1.jpg" style="height:250px; width:375px" />
<img alt="" src="/images/events/bring2.jpg" style="height:250px; width:375px" />
<img alt="" src="/images/events/bring3.jpg" style="height:250px; width:375px" />
<img alt="" src="/images/events/bring4.jpg" style="height:250px; width:375px" />
</p>
HTML
)
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
        $this->setReference('event-anti-flag-old', $event11);
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
        $this->setReference('event-rhcp-old', $event12);
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
        $this->setReference('event-dragon-old', $event13);
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
        $this->setReference('event-torvald-old', $event14);
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
        $this->setReference('event-bmth-old', $event15);
        $manager->persist($event15);

        $manager->flush();
    }

    /**
     * Prepare directories
     */
    private function prepareDirectories()
    {
        if (!file_exists($this->imageWebDirectory)) {
            mkdir($this->imageWebDirectory, 0777, true);
        }
    }

    /**
     * Prepare images
     */
    private function prepareImages()
    {
        //Main images
        copy($this->imageFixturesDirectory.'/zaxid.jpg', $this->imageWebDirectory.'/zaxid.jpg');
        copy($this->imageFixturesDirectory.'/bring.jpg', $this->imageWebDirectory.'/bring.jpg');
        copy($this->imageFixturesDirectory.'/torvald.jpg', $this->imageWebDirectory.'/torvald.jpg');
        copy($this->imageFixturesDirectory.'/group-img-1.jpg', $this->imageWebDirectory.'/group-img-1.jpg');
        copy($this->imageFixturesDirectory.'/group-img-2.jpg', $this->imageWebDirectory.'/group-img-2.jpg');
        copy($this->imageFixturesDirectory.'/group-img-3.jpg', $this->imageWebDirectory.'/group-img-3.jpg');
        copy($this->imageFixturesDirectory.'/somali.jpg', $this->imageWebDirectory.'/somali.jpg');
        copy($this->imageFixturesDirectory.'/ffdp.jpg', $this->imageWebDirectory.'/ffdp.jpg');
        copy($this->imageFixturesDirectory.'/rhcp.jpg', $this->imageWebDirectory.'/rhcp.jpg');
        copy($this->imageFixturesDirectory.'/flag.jpg', $this->imageWebDirectory.'/flag.jpg');
        copy($this->imageFixturesDirectory.'/bring.jpg', $this->imageWebDirectory.'/bring.jpg');

        //Additional images
        copy($this->imageFixturesDirectory.'/bring1.jpg', $this->imageWebDirectory.'/bring1.jpg');
        copy($this->imageFixturesDirectory.'/bring2.jpg', $this->imageWebDirectory.'/bring2.jpg');
        copy($this->imageFixturesDirectory.'/bring3.jpg', $this->imageWebDirectory.'/bring3.jpg');
        copy($this->imageFixturesDirectory.'/bring4.jpg', $this->imageWebDirectory.'/bring4.jpg');
        copy($this->imageFixturesDirectory.'/zaxid1.jpg', $this->imageWebDirectory.'/zaxid1.jpg');
        copy($this->imageFixturesDirectory.'/zaxid2.jpg', $this->imageWebDirectory.'/zaxid2.jpg');
        copy($this->imageFixturesDirectory.'/zaxid3.jpg', $this->imageWebDirectory.'/zaxid3.jpg');
        copy($this->imageFixturesDirectory.'/zaxid4.jpg', $this->imageWebDirectory.'/zaxid4.jpg');
    }
}
