<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Group;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ShortGroupType
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class ShortGroupType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('slug', 'hidden');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Group',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_bundle_short_group_type';
    }
}
