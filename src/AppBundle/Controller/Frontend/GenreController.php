<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Genre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class GenreController extends Controller
{
    /**
     * List genre
     *
     * @Method("GET")
     * @Route("/genres", name="genre_list")
     */
    public function listAction()
    {
        $genres = $this->getDoctrine()->getRepository('AppBundle:Genre')->findAll();

        return $this->render('AppBundle:frontend/genre:list.html.twig',[
            'genres' => $genres
        ]);
    }

    /**
     * Groups by genre
     *
     * @param Genre $slug Genre
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/genre/{slug}/groups", name="genre_group")
     * @ParamConverter("genre", class="AppBundle:Genre")
     */
    public function groupAction(Genre $genre)
    {
        $groups = $this->getDoctrine()->getRepository('AppBundle:Group')->findGroupsByGenre($genre);

        return $this->render('AppBundle:frontend/genre:group.html.twig', [
            'groups' => $groups,
            'genre'  => $genre
        ]);
    }
}