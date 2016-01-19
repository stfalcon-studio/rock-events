<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Genre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Frontend GroupGenreController
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @Route("/group-genres")
 */
class GroupGenreController extends Controller
{
    /**
     * Get all groups for genre
     *
     * @return Response
     *
     * @throws NotFoundHttpException
     *
     * @Method("GET")
     * @Route("/groups/{slug}")
     */
    public function getGroupAction(Genre $slug)
    {
        $groupGenres = $this->getDoctrine()->getRepository('AppBundle:GroupGenre')->getGroupsForGenre($slug->getId());

        if ($groupGenres != null) {

            return $this->render('AppBundle:frontend\group-genres:group.html.twig', [
                'groupGenres' => $groupGenres
            ]);
        } else {
            throw $this->createNotFoundException('The groups does not exist');
        }
    }
}