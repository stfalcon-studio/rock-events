<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Genre;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * GenreAdmin class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GenreAdmin extends Admin
{
    use AdminHelperTrait;

    /**
     * {@inheritdoc}
     */
    public function prePersist($genre)
    {
        /** @var Genre $genre */
        $genre->setCreatedBy($this->getUser())
              ->setUpdatedBy($this->getUser());
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($genre)
    {
        /** @var Genre $genre */
        $genre->setUpdatedBy($this->getUser());
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name', null, [
                'label' => 'Назва',
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
            ->add('imageFile', 'file', [
                'label'    => 'Зображення',
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
            ]);
    }
}
