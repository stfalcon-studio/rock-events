<?php

namespace AppBundle\Form\Type;

use AppBundle\Form\IntToDateTimeTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class GroupType
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GroupType extends AbstractType
{
    /**
     * @var ObjectManager $manager Object Manager
     */
    private $manager;

    /**
     * Constructor
     *
     * @param ObjectManager $manager Object Manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                'label' => 'Ім’я',
                'attr'  => [
                    'class' => 'form-control',
                ],
            ])
            ->add('description', 'ckeditor', [
                'label' => 'Опис',
                'attr'  => [
                    'class' => 'form-control',
                    'rows'  => 7,
                ],
            ])
            ->add('country', 'text', [
                'label' => 'Ім’я',
                'attr'  => [
                    'class' => 'form-control',
                ],
            ])
            ->add('city', 'text', [
                'label' => 'Ім’я',
                'attr'  => [
                    'class' => 'form-control',
                ],
            ])
            ->add('foundedAt', 'integer', [
                'label' => 'Рік створення',
                'attr'  => [
                    'class' => 'form-control',
                ],
            ])
            ->add('imageFile', 'file', [
                'label'    => 'Зображення',
                'required' => false,
            ])
            ->add('submit', 'submit', [
                'label' => 'Зберегти',
                'attr'  => [
                    'class' => 'btn btn-success',
                ],
            ]);

        $builder->get('foundedAt')
                ->addModelTransformer(new IntToDateTimeTransformer($this->manager));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Form\Entity\Group',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'group';
    }
}
