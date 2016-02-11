<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * EventGroupAdmin class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class EventGroupAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('group', null, [
                'label' => 'Гурт'
            ]);
    }
}
