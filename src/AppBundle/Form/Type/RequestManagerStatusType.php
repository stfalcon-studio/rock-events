<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * RequestManagerStatusType class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class RequestManagerStatusType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => \AppBundle\DBAL\Types\RequestManagerStatusType::getChoices(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'choice';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'request_manager_status';
    }
}
