<?php

namespace AppBundle\EntityListener;

use AppBundle\DBAL\Types\RequestManagerStatusType;
use AppBundle\Entity\ManagerGroup;
use AppBundle\Entity\RequestManager;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * RequestManagerListener class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class RequestManagerListener
{
    /**
     * Pre update
     *
     * @param RequestManager     $manager Request manager
     * @param LifecycleEventArgs $args    Arguments
     *
     * @todo fix revision to preUpdate
     */
    public function postUpdate(RequestManager $manager, LifecycleEventArgs $args)
    {
        if ($manager instanceof RequestManager) {
            $em = $args->getEntityManager();

            $uow = $em->getUnitOfWork();

            $changes  = $uow->getEntityChangeSet($manager);
            $newValue = $changes['status'][1];

            if (RequestManagerStatusType::ACCEPTED === $newValue) {
                $user = $manager->getRequestedBy();

                $user->setFullName($manager->getFullName())
                     ->setPhone($manager->getPhone())
                     ->addRole('ROLE_MANAGER');

                $em->persist($user);

                $requestGroups = $manager->getRequestManagerGroups();
                foreach ($requestGroups as $requestGroup) {
                    $managerGroup = (new ManagerGroup())
                        ->setGroup($requestGroup->getGroup())
                        ->setManager($user);

                    $em->persist($managerGroup);
                }

                $em->flush();
            }
        }
    }
}
