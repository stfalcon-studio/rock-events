<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * EventAdmin class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class EventAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper->add('name', null, [
            'label' => 'Назва',
        ])
                   ->add('description', null, [
                       'label' => 'Опис',
                   ])
                   ->add('country', null, [
                       'label' => 'Країна',
                   ])
                   ->add('city', null, [
                       'label' => 'Місто',
                   ])
                   ->add('address', null, [
                       'label' => 'Адреса',
                   ])
                   ->add('beginAt', null, [
                       'label' => 'Початок о',
                   ])
                   ->add('endAt', null, [
                       'label' => 'Кінець о',
                   ])
                   ->add('isActive', null, [
                       'label' => 'Публікувати',
                   ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', null, [
            'label' => 'Назва',
        ])
                   ->add('description', null, [
                       'label' => 'Опис',
                   ])
                   ->add('country', null, [
                       'label' => 'Країна',
                   ])
                   ->add('city', null, [
                       'label' => 'Місто',
                   ])
                   ->add('address', null, [
                       'label' => 'Адреса',
                   ])
                   ->add('beginAt', 'datetime', [
                       'label'       => 'Початок о',
                       'date_widget' => 'single_text',
                       'time_widget' => 'single_text',
                   ])
                   ->add('endAt', 'datetime', [
                       'label'       => 'Кінець о',
                       'date_widget' => 'single_text',
                       'time_widget' => 'single_text',
                   ])
                   ->add('isActive', null, [
                       'label' => 'Публікувати',
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
            ->add('country', null, [
                'label' => 'Країна',
            ])
            ->add('city', null, [
                'label' => 'Місто',
            ])
            ->add('address', null, [
                'label' => 'Адреса',
            ])
            ->add('beginAt', null, [
                'label' => 'Початок о',
            ])
            ->add('endAt', null, [
                'label' => 'Кінець о',
            ])
            ->add('isActive', null, [
                'label' => 'Публікувати',
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
            ->add('country', null, [
                'label' => 'Країна',
            ])
            ->add('city', null, [
                'label' => 'Місто',
            ])
            ->add('address', null, [
                'label' => 'Адреса',
            ])
            ->add('beginAt', null, [
                'label' => 'Початок о',
            ])
            ->add('endAt', null, [
                'label' => 'Кінець о',
            ])
            ->add('isActive', null, [
                'label' => 'Публікувати',
            ]);
    }

    public function getParentAssociationMapping()
    {
        return 'group';
    }
}
