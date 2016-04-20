<?php

namespace AppBundle\Service;

use AppBundle\Entity\RequestManager;
use AppBundle\Entity\RequestManagerGroup;
use AppBundle\Entity\User;
use AppBundle\Form\Entity\RequestManager as RequestManagerForm;
use Doctrine\ORM\EntityManager;

/**
 * UserService class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class UserService
{
    /**
     * @var EntityManager $entityManager Entity manager
     */
    private $entityManager;

    /**
     * Constructor
     *
     * @param EntityManager $em Entity manager
     */
    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    /**
     * Save request on granting rights manager
     *
     * @param RequestManagerForm $requestManagerForm
     * @param User               $user
     */
    public function saveRequestRightManager(RequestManagerForm $requestManagerForm, User $user)
    {
        $requestManager = (new RequestManager())
            ->setFullName($requestManagerForm->getFullName())
            ->setPhone($requestManagerForm->getPhone())
            ->setText($requestManagerForm->getText())
            ->setRequestedBy($user)
            ->setCreatedBy($user)
            ->setUpdatedBy($user);

        $this->entityManager->persist($requestManager);

        foreach ($requestManagerForm->getGroups() as $group) {
            $group = $this->entityManager->getRepository('AppBundle:Group')->findOneBy([
                'slug' => $group->getSlug(),
            ]);

            $requestManagerGroup = (new RequestManagerGroup())
                ->setGroup($group)
                ->setRequestManager($requestManager);

            $this->entityManager->persist($requestManagerGroup);
        }

        $this->entityManager->flush();
    }
}
