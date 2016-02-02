<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * GroupAdmin class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GroupAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name', null, [
                'label' => 'Назва',
            ])
            ->add('description', null, [
                'label' => 'Опис',
            ])
            ->add('foundedAt', null, [
                'label' => 'Рік заснування',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, [
                'label' => 'Назва',
            ])
            ->add('description', null, [
                'label' => 'Опис',
            ])
            ->add('foundedAt', null, [
                'label' => 'Рік заснування',
            ])
            ->add('imageFile', 'file', [
                'required' => false,
            ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, [
                'label' => 'Назва',
            ])
            ->add('description', null, [
                'label' => 'Опис',
            ])
            ->add('foundedAt', null, [
                'label' => 'Рік заснування',
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
            ->add('name', null, [
                'label' => 'Назва',
            ])
            ->add('description', null, [
                'label' => 'Опис',
            ])
            ->add('foundedAt', null, [
                'label' => 'Рік заснування',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParentAssociationMapping()
    {
        return 'group';
    }
}
