<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * BaseController
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class BaseController extends Controller
{
    /**
     * @param $className
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository($className)
    {
        return $this->getDoctrine()->getManager()->getRepository($className);
    }

    /**
     * @return \Doctrine\ORM\EntityManager|object
     */
    public function getManager()
    {
        return $this->getDoctrine()->getEntityManager();
    }
}