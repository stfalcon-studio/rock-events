<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Group;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Frontend UserController
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class UserController extends Controller
{
    /**
     * User index
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/cabinet", name="user_cabinet_index")
     */
    public function indexAction()
    {
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findEventsByUserBookMark($this->getUser());

        return $this->render('@App/frontend/user/index.html.twig', [
            'events' => $events
        ]);
    }

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

        return $this->render('@App/frontend/user/group.html.twig', [
            'groups' => $groups
        ]);
    }

    /**
     * Genres by user
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/cabinet/genres", name="user_cabinet_genre")
     */
    public function genreAction()
    {
        $genres = $this->getDoctrine()->getRepository('AppBundle:Genre')->findGenresByUser($this->getUser());

        return $this->render('@App/frontend/user/genre.html.twig', [
            'genres' => $genres
        ]);
    }
}
