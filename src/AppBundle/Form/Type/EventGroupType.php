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
                    'label' => 'Назва',
                    'attr'  => [
                        'class' => 'form-control',
                    ],
                ])
                ->add('description', 'textarea', [
                    'label' => 'Опис',
                    'attr'  => [
                        'class' => 'form-control',
                    ],
                ])
                ->add('country', 'text', [
                    'label' => 'Країна',
                    'attr'  => [
                        'class' => 'form-control',
                    ],
                ])
                ->add('city', 'text', [
                    'label' => 'Місто',
                    'attr'  => [
                        'class' => 'form-control',
                    ],
                ])
                ->add('address', 'text', [
                    'label' => 'Адреса',
                    'attr'  => [
                        'class' => 'form-control',
                    ],
                ])
                ->add('beginAt', 'datetime', [
                    'label'       => 'Час початку о',
                    'date_widget' => 'single_text',
                    'time_widget' => 'single_text',
                ])
                ->add('endAt', 'datetime', [
                    'label'       => 'Кінець о',
                    'date_widget' => 'single_text',
                    'time_widget' => 'single_text',
                ])
                ->add('groups', 'collection', [
                    'type'         => new ShortGroupType(),
                    'allow_add'    => true,
                    'by_reference' => false,
                    'label'        => 'Гурти',
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
        $view->vars['groups'] = $this->em->getRepository('AppBundle:Group')->findGroupsByManager($this->token->getToken()->getUser());
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
