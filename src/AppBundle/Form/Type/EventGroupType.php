<?php

namespace AppBundle\Form\Type;

use AppBundle\Form\Entity\Event;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class EventGroupType
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class EventGroupType extends AbstractType
{
    /**
     * @var ObjectManager $em Object Manager
     */
    private $em;

    /**
     * @var TokenStorageInterface $token Token Storage
     */
    private $token;

    /**
     * Constructor
     *
     * @param ObjectManager         $em    Object Manager
     * @param TokenStorageInterface $token Token Storage
     */
    public function __construct(ObjectManager $em, TokenStorageInterface $token)
    {
        $this->em    = $em;
        $this->token = $token;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', [
            'label'      => 'Назва',
            'label_attr' => [
                    'class' =>
                        'profile-form__label',
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
                        'class' => 'profile-form__input',
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
                ->add('address', 'text', [
                    'label'      => 'Адреса',
                    'label_attr' => [
                        'class' => 'profile-form__label',
                    ],
                    'attr'       => [
                        'class' => 'profile-form__input',
                    ],
                ])
                ->add('beginAt', 'datetime', [
                    'label'       => 'Час початку о',
                    'label_attr'  => [
                        'class' => 'profile-form__label',
                    ],
                    'attr'        => [
                        'class' => 'profile-form__input',
                    ],
                    'date_widget' => 'single_text',
                    'time_widget' => 'single_text',
                ])
                ->add('endAt', 'datetime', [
                    'label'       => 'Кінець о',
                    'label_attr'  => [
                        'class' => 'profile-form__label',
                    ],
                    'attr'        => [
                        'class' => 'profile-form__input',
                    ],
                    'date_widget' => 'single_text',
                    'time_widget' => 'single_text',
                ])
                ->add('groups', 'collection', [
                    'label'        => false,
                    'type'         => new ShortGroupType(),
                    'allow_add'    => true,
                    'by_reference' => false,
                    'attr'         => [
                        'style' => 'display:none',
                    ],
                ]);
    }

    /**
     * {@inheritdoc}
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $user = $this->token->getToken()->getUser();

        $groupRepository = $this->em->getRepository('AppBundle:Group');

        $view->vars['groups'] = $groupRepository->findGroupsByManager($user);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Form\Entity\Event',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'event_groups';
    }
}
