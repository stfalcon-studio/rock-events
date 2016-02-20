<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Group;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * LoadGroupData
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class LoadGroupData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * @var string $imageFixturesDirectory Image fixtures directory
     */
    private $imageFixturesDirectory = '';

    /** @var string $imageWebDirectory Image Web directory */
    private $imageWebDirectory = __DIR__.'/../../../../web/images/groups';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->imageFixturesDirectory = __DIR__.'/../../Resources/fixtures/images/groups';
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
        /**
         * @var \AppBundle\Entity\User $userAdmin
         */
        $userAdmin = $this->getReference('user-admin');

        $this->prepareDirectories();
        $this->prepareImages();

        $group1 = (new Group())
            ->setName('Enter Shikari')
            ->setDescription('<p>Enter Shikari (стилизованно &Sigma;&Pi;&Tau;&Sigma;R SH&Phi;&Kappa;&Delta;R&Phi;) &mdash; британская пост-хардкор группа, образованная в 2003 году, в городе Сент-Олбанс. Стиль коллектива сочетает пост-хардкор с элементами различных электронных жанров, таких как дабстеп, транс и иногда драм-н-бэйс.&nbsp;</p><p>Дебютный альбом Enter Shikari, Take to the Skies, был выпущен 19 марта 2007 и достиг четвёртой позиции в британском хит-параде UK Albums Chart. Их второй диск, Common Dreads, вышел 15 июня 2009 и дебютировал в UK Albums Chart с шестнадцатой строчки. Их третья пластинка, A Flash Flood Of Colour, была издана 16 января 2012 и дебютировала с четвёртой строчки хит-парада. Группа завоевала большое количество поклонников благодаря своей страничке на сайте MySpace, где они публиковали все свои работы.</p><p>&laquo;Шикари&raquo; на языках фарси, хинди, непали, урду и панджаби значит &laquo;охотник&raquo;[источник не указан 785 дней]. Это персонаж в пьесе, которую вокалист коллектива Роутон Рейнольдс написал ещё до создания группы. Шикари является метафорой позитивной агрессии. Он есть сила в человеке, надежда, дающая энергию охотиться за панацеей от проблем[источник не указан 785 дней].</p><p>Члены группы являются приверженцами DIY-этики.</p><p>19 января 2015 года вышел 4-й студийный альбом под названием &laquo;The Mindsweep&raquo;.</p><p><img alt="" src="/images/groups/shikari1.jpg" style="height:200px; width:300px" /><img alt="" src="/images/groups/shikari2.jpg" style="height:200px; width:300px" /><img alt="" src="/images/groups/shikari3.jpg" style="height:200px; width:300px" /><img alt="" src="/images/groups/shikari4.jpg" style="height:200px; width:300px" /></p>')
            ->setCountry('Великобританія')
            ->setCity('Гартфордшир')
            ->setFoundedAt(new \DateTime('2003-1-1 0:0:0'))
            ->setImageName('shikari.jpg')
            ->setSlug('shikari')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('group-enter-shikari', $group1);
        $manager->persist($group1);

        $group2 = (new Group())
            ->setName('Bring me the horizon')
            ->setDescription('<p>Bring Me The Horizon (також BMTH) - англійський металкор гурт з міста Шеффілда, заснований в 2004 році. В даний час група складається з вокаліста Олівера Сайкса, гітариста Лі Малії, басиста Метта Кіна, барабанщика Метта Ніколлса і клавішника Джордана Фіша. На даний момент гурт підписаний на глобальний лейбл RCA Records та Epitaph Records по США. На початку творчості гурт грав в стилі дезкор але згодом вони перейшли на металкор. А їхні останні сингли (&quot;Drown&quot; та &quot;Don&#39;t Look Down&quot;) орієнтуються на менш важких жанрах рок-музики.</p><p><img alt="" src="/images/groups/bring1.jpg" style="height:250px; width:375px" /><img alt="" src="/images/groups/bring2.jpg" style="height:250px; width:375px" /><img alt="" src="/images/groups/bring3.jpg" style="height:250px; width:375px" /><img alt="" src="/images/groups/bring4.jpg" style="height:250px; width:375px" /></p>')
            ->setCountry('Великобританія')
            ->setCity('Шеффілд')
            ->setFoundedAt(new \DateTime('2004-1-1 0:0:0'))
            ->setImageName('bring.jpg')
            ->setSlug('bmth')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('group-bmth', $group2);
        $manager->persist($group2);

        $group3 = (new Group())
            ->setName('Jinjer')
            ->setDescription('<p>Jinjer &mdash; украинская метал-группа, основанная в 2009 году в городе Горловка, Донецкой области. В их музыке сочетаются элементы прогрессивного металкора, грув-метала и прогрессивного дэт-метала. С момента существования группа выпустила один полноформатный альбом, два мини-альбома, пять синглов и 5 клипов. После издания полноформатного альбома стиль группы сместился более в сторону дэт-метала.</p><p><span style="font-size:18px"><strong>Склад групи:</strong></span></p><ul><li>Тетяна Шмайлюк - вокал&nbsp;</li><li>Роман Ібрамхалілов - гітара</li><li>Євген Мантулін - ударні</li><li>Євген Абдюханов - бас-гітара</li></ul><p><img alt="" src="/images/groups/jinjer1.jpg" style="height:250px; width:375px" /><img alt="" src="/images/groups/jinjer2.jpg" style="height:250px; width:375px" /><img alt="" src="/images/groups/jinjer3.jpg" style="height:250px; width:375px" /><img alt="" src="/images/groups/jinjer4.jpg" style="height:250px; width:375px" /></p>')
            ->setCountry('Україна')
            ->setCity('Горлівка')
            ->setFoundedAt(new \DateTime('2009-1-1 0:0:0'))
            ->setImageName('jinjer.jpg')
            ->setSlug('jinjer')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('group-jinjer', $group3);
        $manager->persist($group3);

        $group4 = (new Group())
            ->setName('Anti-Flag')
            ->setDescription('Anti-Flag — американская панк-рок-группа из Питтсбурга, Пенсильвания. В состав группы входят вокалист и гитарист Джастин Сэйн (Justin Sane), барабанщик Пэт Тетик (Pat Thetic), которые основали группу; а также гитарист Крис Хед (Chris Head) и вокалист/бас-гитарист Крис № 2 (Chris Barker).')
            ->setCountry('США')
            ->setCity('Пітсбург')
            ->setFoundedAt(new \DateTime('2003-1-1 0:0:0'))
            ->setImageName('anti-flag.jpg')
            ->setSlug('anti-flag')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('group-anti-flag', $group4);
        $manager->persist($group4);

        $group5 = (new Group())
            ->setName('Red Hot Chili Peppers')
            ->setCountry('США')
            ->setCity('Лос-Анджелес')
            ->setDescription('Red Hot Chili Peppers (часто используется аббревиатура RHCP; с англ. — «красные острые чилийские перцы») — американская рок-группа, образованная в 1983 году в Калифорнии вокалистом Энтони Кидисом, басистом Майклом Бэлзари (больше известным как Фли), гитаристом Хиллелом Словаком и барабанщиком Джеком Айронсом. Обладает 7 премиями «Грэмми». Во всём мире проданы более 80 миллионов копий их альбомов')
            ->setImageName('rhcp.jpg')
            ->setSlug('rhcp')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('group-rhcp', $group5);
        $manager->persist($group5);

        $group6 = (new Group())
            ->setName('Five finger death punch')
            ->setCountry('США')
            ->setCity('Лас-Вегас')
            ->setDescription('«Five Finger Death Punch» (вимова: Файв-Фінґер-Дез-Панч) — американський гурт, що грає грув-метал. Виник 2005 року у Лас-Вегасі, Невада. Назва гурту означає «смертельний удар п\'ятьма пальцями» й походить із класичних фільмів про східні єдиноборства. Дебютний альбом «The Way of the Fist» було видано 2007 року, після чого гурт почав швидко здобувати популярність. Було продано більше 2,6 млн альбомів у США.')
            ->setImageName('ffdp.jpg')
            ->setSlug('ffdp')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('group-ffdp', $group6);
        $manager->persist($group6);

        $group7 = (new Group())
            ->setName('Coldplay')
            ->setCountry('Великобританія')
            ->setCity('Лондон')
            ->setDescription('Coldplay — британський рок-гурт, створений 1996 року. Грає в жанрах брітпоп, альтернативний рок, інді-рок, нью-рейв. Здобув міжнародне визнання завдяки синглу Yellow , який вийшов 2000 року, та другому студійному альбому A Rush of Blood to the Head, 2002 року. Один із найпопулярніших рок-гуртів світу; 2009 року часопис Rolling Stone визнав «Колдплей» четвертим найкращим музичним виконавцем 2000-х років[1]. Крім музичної діяльності, музиканти активно беруть участь у доброчинних заходах.')
            ->setImageName('coldplay.jpg')
            ->setSlug('coldplay')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('group-coldplay', $group7);
        $manager->persist($group7);

        $group8 = (new Group())
            ->setName('OneRepublic')
            ->setCountry('США')
            ->setCity('Колорадо-Спрінгз')
            ->setDescription('«OneRepublic» — американський поп-рок гурт, заснований 2002 року у Колорадо-Спрінгзі. Популярність гурту приніс сингл «Apologize», який став у США тричі платиновим і досяг третього місця в хіт-параді Великобританії 2007 року. Ремікс на пісню був включений до альбому Тімбаленда «Shock Value» і в дебютний альбом OneRepublic «Dreaming Out Loud».')
            ->setImageName('onerepublic.jpg')
            ->setSlug('onerepublic')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('group-onerepublic', $group8);
        $manager->persist($group8);

        $group9 = (new Group())
            ->setName('Imagine Dragons')
            ->setCountry('США')
            ->setCity('Лас-Вегас')
            ->setDescription('Imagine Dragons — американская инди-рок-группа, образованная в Лас-Вегасе, штат Невада в 2008 году. Стали известны после выпуска их дебютного студийного альбома Night Visions в сентябре 2012 года. Американский журнал Billboard назвал их самыми яркими новыми звёздами 2013 года, а журнал Rolling Stone назвал их сингл «Radioactive» самым большим рок-хитом года')
            ->setImageName('imagine-dragons.jpg')
            ->setSlug('imagine-dragons')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('group-gragon', $group9);
        $manager->persist($group9);

        $group10 = (new Group())
            ->setName('O.Torvald')
            ->setCountry('Україна')
            ->setCity('Київ')
            ->setDescription('O.Torvald (Оторвальд) — украинская рок-группа, исполняющая песни на украинском языке. Образована в 2005 году в Полтаве. В 2006 году музыканты переехали в Киев. В 2008 году вышел дебютный альбом «O.Torvald», вторая пластинка вышла в 2011 году, она получила название «В Тобі». Третий альбом получил название «Акустичний», выпустили его в 2012 году. Четвёртый альбом «Примат» вышел в конце 2012 года. Последний альбом «Ти є» вышел в конце 2014 года.')
            ->setImageName('torvald.jpg')
            ->setSlug('torvald')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $manager->persist($group10);
        $this->setReference('group-torvald', $group10);

        $group11 = (new Group())
            ->setName('Somali Yacht Club')
            ->setCountry('Україна')
            ->setCity('Львів')
            ->setDescription('Somali Yacht Club - український рок-гурт, який грає у стилі психоделік.')
            ->setImageName('somali.jpg')
            ->setSlug('somali')
            ->setActive(true)
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $manager->persist($group11);
        $this->setReference('group-somali', $group11);

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
        copy($this->imageFixturesDirectory.'/shikari.jpg', $this->imageWebDirectory.'/shikari.jpg');
        copy($this->imageFixturesDirectory.'/bring.jpg', $this->imageWebDirectory.'/bring.jpg');
        copy($this->imageFixturesDirectory.'/jinjer.jpg', $this->imageWebDirectory.'/jinjer.jpg');
        copy($this->imageFixturesDirectory.'/anti-flag.jpg', $this->imageWebDirectory.'/anti-flag.jpg');
        copy($this->imageFixturesDirectory.'/rhcp.jpg', $this->imageWebDirectory.'/rhcp.jpg');
        copy($this->imageFixturesDirectory.'/ffdp.jpg', $this->imageWebDirectory.'/ffdp.jpg');
        copy($this->imageFixturesDirectory.'/coldplay.jpg', $this->imageWebDirectory.'/coldplay.jpg');
        copy($this->imageFixturesDirectory.'/onerepublic.jpg', $this->imageWebDirectory.'/onerepublic.jpg');
        copy($this->imageFixturesDirectory.'/imagine-dragons.jpg', $this->imageWebDirectory.'/imagine-dragons.jpg');
        copy($this->imageFixturesDirectory.'/torvald.jpg', $this->imageWebDirectory.'/torvald.jpg');
        copy($this->imageFixturesDirectory.'/somali.jpg', $this->imageWebDirectory.'/somali.jpg');

        //Additional images
        copy($this->imageFixturesDirectory.'/bring1.jpg', $this->imageWebDirectory.'/bring1.jpg');
        copy($this->imageFixturesDirectory.'/bring2.jpg', $this->imageWebDirectory.'/bring2.jpg');
        copy($this->imageFixturesDirectory.'/bring3.jpg', $this->imageWebDirectory.'/bring3.jpg');
        copy($this->imageFixturesDirectory.'/bring4.jpg', $this->imageWebDirectory.'/bring4.jpg');
        copy($this->imageFixturesDirectory.'/jinjer1.jpg', $this->imageWebDirectory.'/jinjer1.jpg');
        copy($this->imageFixturesDirectory.'/jinjer2.jpg', $this->imageWebDirectory.'/jinjer2.jpg');
        copy($this->imageFixturesDirectory.'/jinjer3.jpg', $this->imageWebDirectory.'/jinjer3.jpg');
        copy($this->imageFixturesDirectory.'/jinjer4.jpg', $this->imageWebDirectory.'/jinjer4.jpg');
        copy($this->imageFixturesDirectory.'/shikari1.jpg', $this->imageWebDirectory.'/shikari1.jpg');
        copy($this->imageFixturesDirectory.'/shikari2.jpg', $this->imageWebDirectory.'/shikari2.jpg');
        copy($this->imageFixturesDirectory.'/shikari3.jpg', $this->imageWebDirectory.'/shikari3.jpg');
        copy($this->imageFixturesDirectory.'/shikari4.jpg', $this->imageWebDirectory.'/shikari4.jpg');
    }
}
