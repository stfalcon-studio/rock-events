<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Event;
use AppBundle\Entity\EventGroup;
use Doctrine\Common\Collections\ArrayCollection;
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
        /** @var EventGroup[] $eventGroups */
        $eventGroups = new ArrayCollection();

        /** @var Event $event */
        /** @var EventGroup $eventGroup */
        foreach ($event->getEventGroups() as $eventGroup) {
            $eventGroups[] = $eventGroup->setEvent($event);
        }

        $event->setEventGroups($eventGroups)
              ->setCreatedBy($this->getUser())
              ->setUpdatedBy($this->getUser());
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($event)
    {
        /** @var EventGroup[] $eventGroups */
        $eventGroups = new ArrayCollection();

        /** @var Event $event */
        /** @var EventGroup $eventGroup */
        foreach ($event->getEventGroups() as $eventGroup) {
            if (null === $eventGroup->getEvent()) {
                $eventGroup->setEvent($event);
            }
            $eventGroups[] = $eventGroup;
        }

        $event->setEventGroups($eventGroups)
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
            ->add('beginAt', 'sonata_type_datetime_picker', [
                'label'              => 'Початок о',
                'data'               => new \DateTime(),
                'read_only'          => true,
                'dp_side_by_side'    => true,
                'dp_use_current'     => true,
                'dp_use_seconds'     => true,
                'dp_minute_stepping' => 1,
                'format'             => 'dd.MM.yyyy, HH:mm',
                'attr'               => [
                    'data-date-format' => 'DD.MM.YYYY, HH:mm',
                ],
            ])
            ->add('endAt', 'sonata_type_datetime_picker', [
                'label'              => 'Кінець о',
                'data'               => new \DateTime(),
                'read_only'          => true,
                'dp_side_by_side'    => true,
                'dp_use_current'     => true,
                'dp_use_seconds'     => true,
                'dp_minute_stepping' => 1,
                'format'             => 'dd.MM.yyyy, HH:mm',
                'attr'               => [
                    'data-date-format' => 'DD.MM.YYYY, HH:mm',
                ],
            ])
            ->add('isActive', null, [
                'label' => 'Публікувати',
            ])
            ->add('imageFile', 'file', [
                'label'    => 'Зображення',
                'required' => false,
            ])
            ->add('eventGroups', 'sonata_type_collection', [
                'label'        => 'Гурти',
                'by_reference' => true,
                'required'     => false,
            ],
            [
                'edit'            => 'inline',
                'inline'          => 'table',
                'link_parameters' => [
                    'context' => 'default',
                ],
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
