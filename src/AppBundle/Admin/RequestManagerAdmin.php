<?php

namespace AppBundle\Admin;

use AppBundle\Entity\RequestManager;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * RequestManagerAdmin class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class RequestManagerAdmin extends Admin
{
    use AdminHelperTrait;

    /**
     * {@inheritdoc}
     */
    public function prePersist($requestManager)
    {
        /** @var RequestManager $requestManager */
        $requestManager->setCreatedBy($this->getUser())
                       ->setUpdatedBy($this->getUser());
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($requestManager)
    {
        /** var RequestManager $requestManager */
        $requestManager->setUpdatedBy($this->getUser());
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('fullName', null, [
                'label' => 'ФІО',
            ])
            ->add('phone', null, [
                'label' => 'Телефон',
            ])
            ->add('text', null, [
                'label' => 'Текст',
            ])
            ->add('status', null, [
                'label' => 'Статус',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('user', 'entity', [
                'label' => 'Юзер',
                'class' => 'AppBundle\Entity\User',
            ])
            ->add('fullName', null, [
                'label' => 'ФІО',
            ])
            ->add('phone', null, [
                'label' => 'Телефон',
            ])
            ->add('text', null, [
                'label' => 'Текст',
            ])
            ->add('status', null, [
                'label' => 'Статус',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('fullName', null, [
                'label' => 'ФІО',
            ])
            ->add('phone', null, [
                'label' => 'Телефон',
            ])
            ->add('text', null, [
                'label' => 'Текст',
            ])
            ->add('status', null, [
                'label' => 'Статус',
            ])
            ->add('_action', 'actions', [
                'actions' => [
                    'show'   => [],
                    'edit'   => [],
                    'delete' => [],
                ],
                'label'   => 'Дії',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fullName', null, [
                'label' => 'ФІО',
            ])
            ->add('phone', null, [
                'label' => 'Телефон',
            ])
            ->add('text', null, [
                'label' => 'Текст',
            ])
            ->add('status', null, [
                'label' => 'Статус',
            ]);
    }
}
