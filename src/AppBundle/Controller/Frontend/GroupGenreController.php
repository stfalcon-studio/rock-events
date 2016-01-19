<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Genre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @Route("/genres/{slug}")
     * @ParamConverter("genre", class="AppBundle:Genre")
     */
    public function getGroupAction(Genre $genre)
    {
        $groupGenres = $this->getDoctrine()->getRepository('AppBundle:GroupGenre')->getGroupsForGenre($genre->getId());

        if ($groupGenres != null) {

            return $this->render('AppBundle:frontend\group-genres:group.html.twig', [
                'groupGenres' => $groupGenres
            ]);
        } else {
            throw $this->createNotFoundException('The groups does not exist');
        }
    }
}