<?php

namespace AppBundle\EntityListener;

use AppBundle\Entity\Event;
use AppBundle\Entity\Group;
use AppBundle\Entity\User;
use OldSound\RabbitMqBundle\RabbitMq\Producer;

/**
 * EventListener class
 *
 * @author Yevgeniy Zholkevskiy <zhenya.zholkevskiy@gmail.com>
 */
class EventListener
{
    /** @var Producer $producer Producer */
    private $producer;

    /**
     * Constructor
     *
     * @param Producer $producer Producer
     */
    public function __construct(Producer $producer)
    {
        $this->producer = $producer;
    }

    /**
     * Post persist
     *
     * @param Event $event Event
     */
    public function prePersist(Event $event)
    {
        /** @var array $userEmails */
        $userEmails = [];
        foreach ($event->getEventGroups() as $eventGroup) {
            /** @var Group $group */
            $group = $eventGroup->getGroup();
            foreach ($group->getUserGroups() as $userGroup) {
                $user = $userGroup->getUser()->getEmail();
                if (!in_array($user, $userEmails)) {
                    $userEmails[] = $user;
                }
            }
        }

        $message = [
            'users' => $userEmails,
            'topic' => $event->getName(),
            'text'  => strip_tags($event->getDescription()),
        ];

        $this->producer->setContentType('application/json');
        $this->producer->publish(serialize($message));
    }
}
