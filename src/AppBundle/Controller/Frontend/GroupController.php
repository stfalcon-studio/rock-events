<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Group;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Frontend GroupController
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @Route("/groups")
 */
class GroupController extends Controller
{
    /**
     * Group list
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/", name="groups_index")
     */
    public function indexAction()
    {
        $groups = $this->getDoctrine()->getRepository('AppBundle:Group')->findAll();

        return $this->render('AppBundle:frontend\group:index.html.twig', [
            'groups' => $groups,
        ]);
    }

    /**
     * Group show
     *
     * @param Group $slug
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/{slug}", requirements={"slug" = "\d+"}, name="groups_show")
     */
    public function showAction(Group $slug)
    {
        $genres = $this->getDoctrine()->getRepository('AppBundle:Group')->getGenres($slug->getId());

        return $this->render('AppBundle:frontend\group:show.html.twig', [
            'group'  => $slug,
            'genres' => $genres
        ]);
    }
}