<?php

namespace AppBundle\Form\Type;

use AppBundle\DBAL\Types\RequestManagerStatusType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
        $builder->add('name', 'text', [
                    'label' => 'Ім’я',
                    'attr'  => [
                        'class' => 'form-control',
                    ],
                ])
                ->add('surname', 'text', [
                    'label' => 'Прізвище',
                    'attr'  => [
                        'class' => 'form-control',
                    ],
                ])
                ->add('phone', 'text', [
                    'label' => 'Телефон',
                    'attr'  => [
                        'class' => 'form-control',
                    ],
                ])
                ->add('text', 'ckeditor', [
                    'label' => 'Заявка',
                    'attr'  => [
                        'class'       => 'form-control',
                        'rows'        => 7,
                        'placeholder' => 'Привіт! Я менеджер гурту Sinoptik, Валерія Донець.
Мій контактний телефон - 0975645345.
Посилання на офіційну спільноту в вк - http://vk.com/sinoptik_band',
                    ],
                ])
                ->add('groups', 'collection', [
                    'type'         => new ShortGroupType(),
                    'allow_add'    => true,
                    'by_reference' => false,
                    'label'        => 'Гурти',
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
