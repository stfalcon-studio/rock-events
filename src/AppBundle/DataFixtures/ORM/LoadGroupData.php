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
            ->setSlug('shikari')
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('group-enter-shikari', $group1);
        $manager->persist($group1);

        $group2 = (new Group())
            ->setName('Bring me the horizon')
            ->setDescription('На данный момент группа имеет 5 выпущенных полноформатных альбомов и 1 мини-альбом, ставший их дебютным релизом. На протяжении карьеры участники старались экспериментировать со звучанием: ранние релизы имели более тяжелый звук и были классифицированы как дэткор, металкор и маткор, в настоящее же время в звучание группы добавились элементы мелодичного хардкора, альтернативного, электронного и пост-рока. Изначально, бессменный вокалист и фронтмен Оливер Сайкс владел лишь экстремальным вокалом, но позже освоил традиционный и значительно увеличил его присутствие в песнях. В 2013 году был выпущен альбом «Sempiternal», принесший группе новую волну популярности и открывший ей перспективы выступления на аренах в качестве хэдлайнера. На следующем альбоме That\'s the Spirit, вышедшем в 2015 году, группа продолжила творческие эксперименты, отказавшись от привычного металкор и пост-хардкор звучания в пользу альтернативного рока.[1]')
            ->setFoundedAt(new \DateTime('2004-1-1 0:0:0'))
            ->setSlug('bmth')
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('group-bmth', $group2);
        $manager->persist($group2);

        $group3 = (new Group())
            ->setName('Jinjer')
            ->setDescription('Jinjer — украинская метал-группа, основанная в 2009 году в городе Горловка, Донецкой области. В их музыке сочетаются элементы прогрессивного металкора, грув-метала и прогрессивного дэт-метала. С момента существования группа выпустила один полноформатный альбом, два мини-альбома, пять синглов и 5 клипов. После издания полноформатного альбома стиль группы сместился более в сторону дэт-метала.')
            ->setFoundedAt(new \DateTime('2009-1-1 0:0:0'))
            ->setSlug('jinjer')
            ->setCreatedBy($userAdmin)
            ->setUpdatedBy($userAdmin);
        $this->setReference('group-jinjer', $group3);
        $manager->persist($group3);

        $manager->flush();
    }
}