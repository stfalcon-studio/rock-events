<?php

namespace AppBundle\Service;

use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;

/**
 * DirectoryNamerService class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class DirectoryNamerService implements DirectoryNamerInterface
{
    /**
     * {@inheritdoc}
     */
    public function directoryName($object, PropertyMapping $mapping)
    {
        return $object->getId();
    }
}
