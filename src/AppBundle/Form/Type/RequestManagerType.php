<?php

namespace AppBundle\Form\Type;

use AppBundle\DBAL\Types\RequestManagerStatusType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RequestManagerType
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class RequestManagerType extends AbstractType
{
    /**
     * @var ObjectManager $em Object Manager
     */
    private $em;

    /**
     * Constructor
     *
     * @param ObjectManager $em Object Manager
     */
    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fullName', 'text', [
                    'label'      => 'ФІО',
                    'label_attr' => [
                        'class' => 'profile-form__label',
                    ],
                    'attr'       => [
                        'class' => 'profile-form__input',
                    ],
                ])
                ->add('phone', 'text', [
                    'label'      => 'Телефон',
                    'label_attr' => [
                        'class' => 'profile-form__label',
                    ],
                    'attr'       => [
                        'class' => 'profile-form__input',
                    ],
                ])
                ->add('text', 'ckeditor', [
                    'label'      => 'Заявка',
                    'label_attr' => [
                        'class' => 'profile-form__label',
                    ],
                    'attr'       => [
                        'class'       => 'profile-form__input',
                        'rows'        => 7,
                        'placeholder' => 'Привіт! Я менеджер гурту Sinoptik, Валерія Донець.
Мій контактний телефон - 0975645345.
Посилання на офіційну спільноту в вк - http://vk.com/sinoptik_band',
                    ],
                ])
                ->add('groups', 'collection', [
                    'label_attr'   => [
                        'style' => 'display: none;',
                    ],
                    'type'         => new ShortGroupType(),
                    'allow_add'    => true,
                    'by_reference' => false,
                    'attr'         => [
                        'class' => 'profile-form__input',
                    ],
                ]);
    }

    /**
     * {@inheritdoc}
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['groups'] = $this->em->getRepository('AppBundle:Group')->findAll();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Form\Entity\RequestManager',
        ]);
    }

    public function getName()
    {
        return 'request_manager';
    }
}
