<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Genre;
use AppBundle\Entity\UserGenre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

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

        if (null === $this->getUser()) {
            return $this->render('AppBundle:frontend/genre:list.html.twig', [
                'genres' => $genres,
            ]);
        }

        $userGenres = $this->getDoctrine()->getRepository('AppBundle:Genre')->findGenresByUser($this->getUser());

        return $this->render('AppBundle:frontend/genre:list.html.twig', [
            'genres'     => $genres,
            'userGenres' => $userGenres,
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
            'genre'  => $genre,
        ]);
    }

    /**
     * Add genre to user bookmark
     *
     * @param Genre $genre Genre
     *
     * @Route("/genre/{slug}/bookmark", name="genre_add_to_bookmark")
     * @ParamConverter("genre", class="AppBundle:Genre")
     *
     * @throws UnauthorizedHttpException Forbidden 401 User not authorized
     *
     * @return RedirectResponse
     */
    public function addToBookmarkAction(Genre $genre)
    {
        if (null === $this->getUser()) {
            throw new UnauthorizedHttpException('Не зареєстрований');
        }

        $user      = $this->getUser();
        $userGenre = (new UserGenre())->setUser($user)->setGenre($genre);

        $em = $this->getDoctrine()->getManager();
        $em->persist($userGenre);
        $em->flush();

        return new JsonResponse('', 201);
    }

    /**
     * Delete genre from user bookmark
     *
     * @param Genre $genre Genre
     * @param string $route Route to redirect after action
     *
     * @Route("/genre/{slug}/bookmark/delete", name="genre_delete_from_bookmark")
     * @ParamConverter("genre", class="AppBundle:Genre")
     *
     * @throws BadRequestHttpException Bab request 400 Request only AJAX
     * @throws UnauthorizedHttpException Forbidden 401 User not authorized
     *
     * @return RedirectResponse
     */
    public function ajaxDeleteFromBookmarkAction(Genre $genre, Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Не правильний запит');
        }

        if (null === $this->getUser()) {
            throw new UnauthorizedHttpException('Не зареєстрований');
        }
        $em        = $this->getDoctrine()->getManager();
        $userGenre = $em->getRepository('AppBundle:UserGenre')->findOneBy([
            'user'  => $this->getUser(),
            'genre' => $genre,
        ]);

        $em->remove($userGenre);
        $em->flush();

        return new JsonResponse('', 204);
    }
}
