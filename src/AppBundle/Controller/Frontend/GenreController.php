<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Genre;
use AppBundle\Entity\UserGenre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * Class GenreController
 *
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GenreController extends Controller
{
    /**
     * List genre
     *
     * @return Response
     *
     * @Route("/genres", name="genre_list")
     */
    public function listAction()
    {
        $user = $this->getUser();

        $genreRepository = $this->getDoctrine()->getRepository('AppBundle:Genre');

        $genres = $genreRepository->findGenresWithCountGroup();

        if (null === $user) {
            return $this->render('AppBundle:frontend/genre:list.html.twig', [
                'genres' => $genres,
            ]);
        }

        $userGenres = $genreRepository->findGenresByUser($user);

        return $this->render('AppBundle:frontend/genre:list.html.twig', [
            'genres'     => $genres,
            'userGenres' => $userGenres,
        ]);
    }

    /**
     * Groups by genre
     *
     * @param Genre $genre Genre
     *
     * @return Response
     *
     * @Route("/genre/{slug}/groups", name="genre_group")
     * @ParamConverter("genre", class="AppBundle:Genre")
     */
    public function groupAction(Genre $genre)
    {
        $user = $this->getUser();

        $groupRepository = $this->getDoctrine()->getRepository('AppBundle:Group');

        $groups = $groupRepository->findGroupsByGenreWithCountLikes($genre);

        if (null == $user) {
            return $this->render('AppBundle:frontend/genre:group.html.twig', [
                'groups' => $groups,
                'genre'  => $genre,
            ]);
        }

        $userGroups = $groupRepository->findGroupsByUser($user);

        return $this->render('AppBundle:frontend/genre:group.html.twig', [
            'groups'     => $groups,
            'genre'      => $genre,
            'userGroups' => $userGroups,
        ]);
    }

    /**
     * Count groups by genre
     *
     * @param Genre $genre Genre
     *
     * @return Response
     */
    public function countGroupsByGenreAction(Genre $genre)
    {
        $likes = $this->getDoctrine()->getRepository('AppBundle:Genre')->findCountGroupsByGenre($genre);

        return $this->render('AppBundle:frontend/genre:count_groups.html.twig', [
            'count_groups' => $likes['count_groups'],
        ]);
    }

    /**
     * Ajax add genre to user bookmark
     *
     * @param Genre $genre Genre
     *
     * @throws UnauthorizedHttpException
     *
     * @return JsonResponse
     *
     * @Route("/genre/{slug}/bookmark", name="genre_add_to_bookmark")
     * @ParamConverter("genre", class="AppBundle:Genre")
     */
    public function ajaxAddToBookmarkAction(Genre $genre)
    {
        if (null === $this->getUser()) {
            throw new UnauthorizedHttpException('Не зареєстрований');
        }

        $user      = $this->getUser();
        $userGenre = (new UserGenre())->setUser($user)->setGenre($genre);

        $em = $this->getDoctrine()->getManager();
        $em->persist($userGenre);
        $em->flush();

        $countLikes = $this->getDoctrine()->getRepository('AppBundle:Genre')->findCountLikesByGenre($genre);

        return new JsonResponse([
            'status'     => true,
            'message'    => 'Success',
            'post_likes' => $countLikes['likes'],
        ], 201);
    }

    /**
     * Ajax delete genre from user bookmark
     *
     * @param Request $request Request
     * @param Genre   $genre   Genre
     *
     * @throws BadRequestHttpException
     * @throws UnauthorizedHttpException
     *
     * @return JsonResponse
     *
     * @Route("/genre/{slug}/bookmark/delete", name="genre_delete_from_bookmark")
     * @ParamConverter("genre", class="AppBundle:Genre")
     */
    public function ajaxDeleteFromBookmarkAction(Request $request, Genre $genre)
    {
        $user = $this->getUser();

        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Не правильний запит');
        }

        if (null === $user) {
            throw new UnauthorizedHttpException('Не зареєстрований');
        }

        $em        = $this->getDoctrine()->getManager();
        $userGenre = $em->getRepository('AppBundle:UserGenre')->findOneBy([
            'user'  => $user,
            'genre' => $genre,
        ]);

        $em->remove($userGenre);
        $em->flush();

        $countLikes = $this->getDoctrine()->getRepository('AppBundle:Genre')->findCountLikesByGenre($genre);

        return new JsonResponse([
            'status'     => true,
            'message'    => 'Success',
            'post_likes' => $countLikes['likes'],
        ]);
    }
}
