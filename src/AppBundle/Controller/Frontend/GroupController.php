<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Genre;
use AppBundle\Entity\Group;
use AppBundle\Entity\UserGroup;
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

/**
 * Frontend GroupController
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class GroupController extends Controller
{
    /**
     * Group list
     *
     * @return Response
     *
     * @Route("/groups", name="group_list")
     */
    public function listAction()
    {
        $user = $this->getUser();

        $groupRepository = $this->getDoctrine()->getRepository('AppBundle:Group');
        $genreRepository = $this->getDoctrine()->getRepository('AppBundle:Genre');

        $groups   = $groupRepository->findGroupsWithCountLike();
        $genres   = $genreRepository->findAllActiveGenres();
        $counties = $groupRepository->findAllCountriesByGroups();
        $cities   = $groupRepository->findAllCitiesByGroups();

        if (null === $user) {
            return $this->render('AppBundle:frontend\group:list.html.twig', [
                'groups'    => $groups,
                'genres'    => $genres,
                'countries' => $counties,
                'cities'    => $cities,
            ]);
        }

        $userGroups = $groupRepository->findGroupsByUser($user);

        return $this->render('AppBundle:frontend\group:list.html.twig', [
            'groups'     => $groups,
            'userGroups' => $userGroups,
            'genres'     => $genres,
            'countries'  => $counties,
            'cities'     => $cities,
        ]);
    }

    /**
     * Group show
     *
     * @param Group $group Group
     *
     * @return Response
     *
     * @Route("/group/{slug}", name="group_show")
     * @ParamConverter("group", class="AppBundle:Group")
     */
    public function showAction(Group $group)
    {
        $groupRepository = $this->getDoctrine()->getRepository('AppBundle:Group');
        $genreRepository = $this->getDoctrine()->getRepository('AppBundle:Genre');

        $genres          = $genreRepository->findGenresByGroup($group);
        $groupCountLikes = $groupRepository->findCountLikesByGroup($group);
        $similarGroups   = $groupRepository->findGroupsByGenres($genres);

        $user = $this->getUser();

        //Delete selected group
        unset($similarGroups[array_search($group, $similarGroups)]);

        if (null === $user) {
            return $this->render('AppBundle:frontend\group:show.html.twig', [
                'group'          => $group,
                'genres'         => $genres,
                'count_like'     => $groupCountLikes['likes'],
                'similar_groups' => $similarGroups,
            ]);
        }

        $userGroups = $groupRepository->findGroupsByUser($this->getUser());

        return $this->render('AppBundle:frontend\group:show.html.twig', [
            'group'          => $group,
            'genres'         => $genres,
            'count_like'     => $groupCountLikes['likes'],
            'similar_groups' => $similarGroups,
            'userGroups'     => $userGroups,
        ]);
    }

    /**
     * Events by group
     *
     * @param Group $group Group
     *
     * @return Response
     *
     * @Route("/group/{slug}/events", name="group_event")
     * @ParamConverter("group", class="AppBundle:Group")
     */
    public function eventAction(Group $group)
    {
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findEventsByGroup($group);

        return $this->render('AppBundle:frontend/group:event.html.twig', [
            'events' => $events,
            'group'  => $group,
        ]);
    }

    /**
     * Return genres by group
     *
     * @param Group $group Group
     *
     * @return Response
     */
    public function genresAction(Group $group)
    {
        $genres = $this->getDoctrine()->getRepository('AppBundle:Genre')->findGenresByGroup($group);

        return $this->render('AppBundle:frontend/group:genres.html.twig', [
            'genres' => $genres,
        ]);
    }

    /**
     * Return next concert by group
     *
     * @param Group $group Group
     *
     * @return Response
     */
    public function nextConcertsAction(Group $group)
    {
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findActualEventsByGroup($group);

        return $this->render('AppBundle:frontend/group:next_concert.html.twig', [
            'group'  => $group,
            'events' => $events,
        ]);
    }

    /**
     * List tags genres by group
     *
     * @param Group $group Group
     *
     * @return Response
     */
    public function genreTagsAction(Group $group)
    {
        $genres = $this->getDoctrine()->getRepository('AppBundle:Genre')->findGenresByGroup($group);

        return $this->render('AppBundle:frontend/group:genre_tags.html.twig', [
            'genres' => $genres,
        ]);
    }

    /**
     * List groups for group page
     *
     * @param array $groups     Array of groups
     * @param array $userGroups Array of user groups
     *
     * @return Response
     */
    public function listGroupWidgetAction(array $groups, array $userGroups = null)
    {
        return $this->render('AppBundle:frontend/group:list_group_widget.html.twig', [
            'groups'     => $groups,
            'userGroups' => $userGroups,
        ]);
    }

    /**
     * Ajax add group to user bookmark
     *
     * @param Request $request Request
     * @param Group   $group   Group
     *
     * @throws BadRequestHttpException
     * @throws UnauthorizedHttpException
     *
     * @return JsonResponse
     *
     * @Route("/group/{slug}/bookmark", name="group_add_to_bookmark")
     * @ParamConverter("group", class="AppBundle:Group")
     */
    public function ajaxAddToBookmarkAction(Request $request, Group $group)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Не правильний запит');
        }

        if (null === $this->getUser()) {
            throw new UnauthorizedHttpException('Не зареєстрований');
        }

        $user      = $this->getUser();
        $userGroup = (new UserGroup())->setUser($user)->setGroup($group);

        $em = $this->getDoctrine()->getManager();
        $em->persist($userGroup);
        $em->flush();

        $countLikes = $this->getDoctrine()->getRepository('AppBundle:Group')->findCountLikesByGroup($group);

        return new JsonResponse([
            'status'     => true,
            'message'    => 'Success',
            'post_likes' => $countLikes['likes'],
        ], 201);
    }

    /**
     * Ajax delete group from user bookmark
     *
     * @param Request $request Request
     * @param Group   $group   Group
     *
     * @throws BadRequestHttpException
     * @throws UnauthorizedHttpException
     *
     * @return JsonResponse
     *
     * @Route("/group/{slug}/bookmark/delete", name="group_delete_from_bookmark")
     * @ParamConverter("group", class="AppBundle:Group")
     */
    public function ajaxDeleteFromBookmarkAction(Request $request, Group $group)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Не правильний запит');
        }

        if (null === $this->getUser()) {
            throw new UnauthorizedHttpException('Не зареєстрований');
        }

        $em = $this->getDoctrine()->getManager();

        $userGroup = $em->getRepository('AppBundle:UserGroup')->findOneBy([
            'user'  => $this->getUser(),
            'group' => $group,
        ]);

        $em->remove($userGroup);
        $em->flush();

        $countLikes = $this->getDoctrine()->getRepository('AppBundle:Group')->findCountLikesByGroup($group);

        return new JsonResponse([
            'status'     => true,
            'message'    => 'Success',
            'post_likes' => $countLikes['likes'],
        ]);
    }

    /**
     * Ajax filter for group
     *
     * @param Request $request Request
     *
     * @throws BadRequestHttpException
     *
     * @return Group[]
     *
     * @Route("/group-filters", name="group_filters")
     */
    public function ajaxEventFilter(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Не правильний запит');
        }

        $user = $this->getUser();

        $groupRepository = $this->getDoctrine()->getRepository('AppBundle:Group');

        $genre   = $request->query->get('genre');
        $country = $request->query->get('country');
        $city    = $request->query->get('city');
        $like    = $request->query->get('like');

        $groups = $groupRepository->findGroupsByFilter($genre, $country, $city, $like);

        if (null === $user) {
            $template = $this->renderView('AppBundle:frontend/group:list_group_widget.html.twig', [
                'groups' => $groups,
            ]);
        } else {
            $userGroups = $groupRepository->findGroupsByUser($user);
            $template   = $this->renderView('AppBundle:frontend/group:list_group_widget.html.twig', [
                'groups'     => $groups,
                'userGroups' => $userGroups,
            ]);
        }

        return new JsonResponse([
            'status'   => true,
            'message'  => 'Success',
            'template' => $template,
        ]);
    }
}
