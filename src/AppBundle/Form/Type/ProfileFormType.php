<?php

namespace AppBundle\Form\Type;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

/**
 * ProfileFormType
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class ProfileFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text', [
                    'label_attr' => [
                        'class' => 'profile-form__label',
                    ],
                    'attr'       => [
                        'class' => 'profile-form__input',
                    ],
                ])
                ->add('email', 'email', [
                    'label_attr' => [
                        'class' => 'profile-form__label',
                    ],
                    'attr'       => [
                        'class' => 'profile-form__input',
                    ],
                ])
                ->add('current_password', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'), [
                    'label_attr'         => [
                        'class' => 'profile-form__label',
                    ],
                    'label'              => 'form.current_password',
                    'translation_domain' => 'FOSUserBundle',
                    'mapped'             => false,
                    'constraints'        => new UserPassword(),
                    'attr'               => [
                        'class' => 'profile-form__input',
                    ],
                ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_user_profile';
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
