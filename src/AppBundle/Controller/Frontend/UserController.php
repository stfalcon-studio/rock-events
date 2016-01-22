<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Group;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends Controller
{
    /**
     * Groups by user
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/cabinet/groups", name="user_cabinet_group")
     */
    public function groupAction()
    {
        $groups = $this->getDoctrine()->getRepository('AppBundle:Group')->findGroupsByUser($this->getUser());

        return $this->render('@App/frontend/user/group.html.twig',[
            'groups' => $groups
        ]);
    }

//    /**
//     * Genres by user
//     *
//     * @return Response
//     *
//     * @Method("GET")
//     * @Route("/cabinet/genres", name="user_cabinet_genre")
//     */
//    public function genreAction()
//    {
//
//    }
}
