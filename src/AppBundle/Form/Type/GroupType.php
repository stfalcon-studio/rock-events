<?php

namespace AppBundle\Form\Type;

use AppBundle\Form\IntToDateTimeTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class GroupType
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class GroupType extends AbstractType
{
    /**
     * @var ObjectManager $manager Object Manager
     */
    private $manager;

    /**
     * Constructor
     *
     * @param ObjectManager $manager Object Manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                'label'      => 'Ім’я',
                'label_attr' => [
                    'class' => 'profile-form__label',
                ],
                'attr'       => [
                    'class' => 'profile-form__input',
                ],
            ])
            ->add('description', 'ckeditor', [
                'label'      => 'Опис',
                'label_attr' => [
                    'class' => 'profile-form__label',
                ],
                'attr'       => [
                    'class' => 'form-control',
                    'rows'  => 7,
                ],
            ])
            ->add('country', 'text', [
                'label'      => 'Країна',
                'label_attr' => [
                    'class' => 'profile-form__label',
                ],
                'attr'       => [
                    'class' => 'profile-form__input',
                ],
            ])
            ->add('city', 'text', [
                'label'      => 'Місто',
                'label_attr' => [
                    'class' => 'profile-form__label',
                ],
                'attr'       => [
                    'class' => 'profile-form__input',
                ],
            ])
            ->add('foundedAt', 'integer', [
                'label'      => 'Рік створення',
                'label_attr' => [
                    'class' => 'profile-form__label',
                ],
                'attr'       => [
                    'class' => 'profile-form__input',
                ],
            ])
            ->add('imageFile', 'file', [
                'label'      => 'Зображення',
                'label_attr' => [
                    'class' => 'profile-form__label',
                ],
                'required'   => false,
            ])
            ->add('submit', 'submit', [
                'label' => 'Зберегти',
                'attr'  => [
                    'style' => 'margin-top: 20px',
                    'class' => 'profile-form__submit',
                ],
            ]);

        $builder->get('foundedAt')->addModelTransformer(new IntToDateTimeTransformer($this->manager));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Form\Entity\Group',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'group';
    }
}
