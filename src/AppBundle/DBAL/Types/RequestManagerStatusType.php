<?php

namespace AppBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * RequestManagerStatus Type
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
final class RequestManagerStatusType extends AbstractEnumType
{
    const SENDED    = 'sended';
    const PROCESSED = 'processed';
    const ACCEPTED  = 'accepted';
    const DENIED    = 'denied';

    protected static $choices = [
        self::SENDED    => 'Sended',
        self::PROCESSED => 'Processed',
        self::ACCEPTED  => 'Accepted',
        self::DENIED    => 'denied',
    ];
}
