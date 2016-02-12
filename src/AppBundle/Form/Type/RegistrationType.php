<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * RegistrationType
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class RegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'email', [
                    'label' => 'Email',
                    'label_attr' => [
                        'class' => 'profile-form__label'
                    ],
                    'attr' => [
                        'class' => 'profile-form__input',
                        'placeholder' => 'Введіть ваш email'
                    ],
                ])
                ->add('username', 'text', [
                    'label' => 'Логін',
                    'label_attr' => [
                        'class' => 'profile-form__label'
                    ],
                    'attr' => [
                        'class' => 'profile-form__input',
                        'placeholder' => 'Введіть ваш логін'
                    ],
                ])
                ->add('plainPassword', 'password', [
                    'label'=>'Пароль',
                    'label_attr' => [
                        'class' => 'profile-form__label',
                    ],
                    'attr' => [
                        'class' => 'profile-form__input',
                        'placeholder' => 'Введіть ваш пароль'
                    ]
                ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\User',
        ]);
    }
}
