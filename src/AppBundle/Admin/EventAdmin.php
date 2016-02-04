<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Event;
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
    use AdminHelperTrait;

    /**
     * {@inheritdoc}
     */
    public function prePersist($event)
    {
        /** @var Event $event */
        $event->setCreatedBy($this->getUser())
              ->setUpdatedBy($this->getUser());
    }

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
        $formMapper
            ->add('name', null, [
                'label' => 'Назва',
            ])
            ->add('slug', null)
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
//                'read_only' => true,
//                'dp_side_by_side' => true,
//                'dp_use_current' => true,
//                'dp_use_seconds' => true,
//                'dp_minute_stepping' => 1,
//                'date_format' => 'dd.MM.YYYY HH:mm',
//                'format' => 'dd.MM.YYYY HH:mm',
            ])
            ->add('endAt', null, [
                'label' => 'Кінець о',
//                'read_only' => true,
//                'dp_side_by_side' => true,
//                'dp_use_current' => true,
//                'dp_use_seconds' => true,
//                'dp_minute_stepping' => 1,
//                'date_format' => 'dd.MM.YYYY HH:mm',
//                'format' => 'dd.MM.YYYY HH:mm',
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
}
