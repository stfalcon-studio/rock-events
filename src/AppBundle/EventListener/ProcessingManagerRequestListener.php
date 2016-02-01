<?php

namespace AppBundle\EventListener;

use AppBundle\DBAL\Types\RequestManagerStatusType;
use AppBundle\Entity\RequestManager;
use AppBundle\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * ProcessingManagerRequestListener class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class ProcessingManagerRequestListener
{
    public function postUpdate(LifecycleEventArgs $args)
    {
        /** @var RequestManager $entity */
        $entity = $args->getEntity();

        if ($entity instanceof RequestManager) {
            $em       = $args->getEntityManager();
            $uow      = $em->getUnitOfWork();
            $oldValue = $uow->getEntityChangeSet($entity);

            if (RequestManagerStatusType::SENT === $oldValue['status'][0]
                && RequestManagerStatusType::ACCEPTED === $oldValue['status'][1]
            ) {
                /** @var User $user */
                $user = $em->getRepository('AppBundle:User')->find($entity->getUser()->getId());
                $user->setFullName($entity->getFullName())
                     ->setPhone($entity->getPhone())
                     ->addRole('ROLE_MANAGER');

                $em->persist($user);
                $em->flush();
            }
        }
    }
}
