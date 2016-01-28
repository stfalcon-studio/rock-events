<?php

namespace AppBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * IntToDateTimeTransformer class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class IntToDateTimeTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager $manager Object Manager
     */
    public $manager;

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
    public function transform($value)
    {
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        $result = new \DateTime();

        if (null !== $value) {
            $result->setDate($value, 1, 1);
        }

        return $result;
    }
}
