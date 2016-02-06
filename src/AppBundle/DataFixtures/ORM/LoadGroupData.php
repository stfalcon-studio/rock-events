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

        $group1 = (new Group())
            ->setName('Enter Shikari')
            ->setDescription('Enter Shikari (стилизованно ΣΠΤΣR SHΦΚΔRΦ) — британская пост-хардкор группа, образованная в 2003 году, в городе Сент-Олбанс. Стиль коллектива сочетает пост-хардкор с элементами различных электронных жанров, таких как дабстеп, транс и иногда драм-н-бэйс.')
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
            ->setDescription('На данный момент группа имеет 5 выпущенных полноформатных альбомов и 1 мини-альбом, ставший их дебютным релизом. На протяжении карьеры участники старались экспериментировать со звучанием: ранние релизы имели более тяжелый звук и были классифицированы как дэткор, металкор и маткор, в настоящее же время в звучание группы добавились элементы мелодичного хардкора, альтернативного, электронного и пост-рока. Изначально, бессменный вокалист и фронтмен Оливер Сайкс владел лишь экстремальным вокалом, но позже освоил традиционный и значительно увеличил его присутствие в песнях. В 2013 году был выпущен альбом «Sempiternal», принесший группе новую волну популярности и открывший ей перспективы выступления на аренах в качестве хэдлайнера. На следующем альбоме That\'s the Spirit, вышедшем в 2015 году, группа продолжила творческие эксперименты, отказавшись от привычного металкор и пост-хардкор звучания в пользу альтернативного рока.[1]')
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
            ->setDescription('Jinjer — украинская метал-группа, основанная в 2009 году в городе Горловка, Донецкой области. В их музыке сочетаются элементы прогрессивного металкора, грув-метала и прогрессивного дэт-метала. С момента существования группа выпустила один полноформатный альбом, два мини-альбома, пять синглов и 5 клипов. После издания полноформатного альбома стиль группы сместился более в сторону дэт-метала.')
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
}
