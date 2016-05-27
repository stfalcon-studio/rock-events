<?php

namespace AppBundle\Service;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * MessageService class
 *
 * @author Yevgeniy Zholkevskiy <zhenya.zholkevskiy@gmail.com>
 */
class MessageService implements ConsumerInterface
{
    /** @var \Swift_Mailer $mailer Mailer */
    private $mailer;

    /** @var string $from From */
    private $from;

    /**
     * Constructor
     *
     * @param \Swift_Mailer $mailer Mailer
     * @param string        $from   From
     */
    public function __construct(\Swift_Mailer $mailer, $from)
    {
        $this->mailer = $mailer;
        $this->from   = $from;
    }

    /**
     * Execute command
     *
     * @param AMQPMessage $msg Message
     */
    public function execute(AMQPMessage $msg)
    {
        $data = unserialize($msg->body);

        foreach ($data['users'] as $user) {
            $message = \Swift_Message::newInstance()
                                     ->setFrom($this->from)
                                     ->setTo($user)
                                     ->setSubject($data['topic'])
                                     ->setBody($data['text']);
            $this->mailer->send($message);
        }

        echo 'Messages sent';
    }
}
