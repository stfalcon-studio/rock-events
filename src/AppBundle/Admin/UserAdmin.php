<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * UserAdmin class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class UserAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username')
            ->add('fullName')
            ->add('email')
            ->add('enabled')
            ->add('roles', 'choice', [
                'choices'  => [
                    'ROLE_USER'    => 'User',
                    'ROLE_MANAGER' => 'Manager',
                    'ROLE_ADMIN'   => 'Admin',
                ],
                'expanded' => false,
                'multiple' => true,
                'required' => false,
            ])
            ->add('lastLogin', 'sonata_type_date_picker')
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('fullName')
            ->add('email')
            ->add('enabled', null, [
                'editable' => true,
            ])
            ->add('rolesAsString', 'string', [
                'label' => 'Roles',
            ])
            ->add('lastLogin')
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
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('username')
            ->add('fullName')
            ->add('email')
            ->add('enabled')
            ->add('lastLogin');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('username')
            ->add('fullName')
            ->add('email')
            ->add('enabled')
            ->add('lastLogin');
    }

    /**
     * {@inheritdoc}
     */
    public function getParentAssociationMapping()
    {
        return 'user';
    }
}
