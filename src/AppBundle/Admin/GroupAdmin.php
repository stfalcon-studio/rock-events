<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Group;
use AppBundle\Entity\GroupGenre;
use Doctrine\Common\Collections\ArrayCollection;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * GroupAdmin class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class GroupAdmin extends Admin
{
    use AdminHelperTrait;

    /**
     * {@inheritdoc}
     */
    public function prePersist($group)
    {
        /** @var GroupGenre[] $groupGenres */
        $groupGenres = new ArrayCollection();

        /** @var Group $group */
        /** @var GroupGenre $groupGenre */
        foreach ($group->getGroupGenres() as $groupGenre) {
            $groupGenres[] = $groupGenre->setGroup($group);
        }

        $group->setGroupGenres($groupGenres)
              ->setCreatedBy($this->getUser())
              ->setUpdatedBy($this->getUser());
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($group)
    {
        /** @var GroupGenre[] $groupGenres */
        $groupGenres = new ArrayCollection();

        /** @var Group $group */
        /** @var GroupGenre $groupGenre */
        foreach ($group->getGroupGenres() as $groupGenre) {
            if (null === $groupGenre->getGroup()) {
                $groupGenre->setGroup($group);
            }
            $groupGenres[] = $groupGenre;
        }

        $group->setGroupGenres($groupGenres)
              ->setUpdatedBy($this->getUser());
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
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
            ->add('slug')
            ->add('description', 'ckeditor', [
                'label'  => 'Опис',
                'config' => [
                    'filebrowserBrowseRoute'           => 'elfinder',
                    'filebrowserBrowseRouteParameters' => [
                        'instance' => 'default',
                    ],
                ],
            ])
            ->add('country', null, [
                'label' => 'Країна',
            ])
            ->add('city', null, [
                'label' => 'Місто',
            ])
            ->add('foundedAt', 'sonata_type_datetime_picker', [
                'label' => 'Рік заснування',
            ])
            ->add('slug', null, [
                'label' => 'Slug',
            ])
            ->add('imageFile', 'file', [
                'label'    => 'Зображення',
                'required' => false,
            ])
            ->add('groupGenres', 'sonata_type_collection', [
                'label'        => 'Жанри',
                'by_reference' => true,
                'required'     => false,
            ], [
                'edit'            => 'inline',
                'inline'          => 'table',
                'link_parameters' => [
                    'context' => 'default',
                ],
            ]);

        /** @var Group $group */
        $group = $this->getSubject();
        if (null === $group->getFoundedAt()) {
            $group->setFoundedAt(new \DateTime());
        }
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
            ->add('country', null, [
                'label' => 'Країна',
            ])
            ->add('city', null, [
                'label' => 'Місто',
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
            ->add('country', null, [
                'label' => 'Країна',
            ])
            ->add('city', null, [
                'label' => 'Місто',
            ])
            ->add('description', null, [
                'label' => 'Опис',
            ])
            ->add('foundedAt', null, [
                'label' => 'Рік заснування',
            ]);
    }
}
