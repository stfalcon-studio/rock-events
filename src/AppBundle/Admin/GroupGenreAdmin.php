<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * GroupGenreAdmin class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GroupGenreAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('genre', null, [
                'label' => 'Жанр'
            ]);
    }
}
