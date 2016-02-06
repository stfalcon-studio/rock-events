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
 */
class GroupController extends Controller
{
    /**
     * Group list
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/groups", name="group_list")
     */
    public function listAction()
    {
        $groups = $this->getDoctrine()->getRepository('AppBundle:Group')->findGroupsWithCountLike();

        if (null === $this->getUser()) {
            return $this->render('AppBundle:frontend\group:list.html.twig', [
                'groups' => $groups,
            ]);
        }

        $userGroups = $this->getDoctrine()->getRepository('AppBundle:Group')->findGroupsByUser($this->getUser());

        return $this->render('AppBundle:frontend\group:list.html.twig', [
            'groups'     => $groups,
            'userGroups' => $userGroups,
        ]);
    }

    /**
     * Group show
     *
     * @param Group $slug Group
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/group/{slug}", name="group_show")
     * @ParamConverter("group", class="AppBundle:Group")
     */
    public function showAction(Group $group)
    {
        $genres = $this->getDoctrine()->getRepository('AppBundle:Genre')->findGenresByGroup($group);

        return $this->render('AppBundle:frontend\group:show.html.twig', [
            'group'  => $group,
            'genres' => $genres,
        ]);
    }

    /**
     * Events by group
     *
     * @param Group $slug Group
     *
     * @return Response
     *
     * @Method("GET")
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
     * Ajax add group to user bookmark
     *
     * @param Group $group Group
     * @param Request $request Request
     *
     * @Route("/group/{slug}/bookmark", name="group_add_to_bookmark")
     * @ParamConverter("group", class="AppBundle:Group")
     *
     * @throws BadRequestHttpException Bab request 400 Request only AJAX
     * @throws UnauthorizedHttpException Forbidden 401 User not authorized
     *
     * @return JsonResponse
     */
    public function ajaxAddToBookmarkAction(Group $group, Request $request)
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

        return new JsonResponse([
            'status'  => true,
            'message' => 'Success',
        ], 201);
    }

    /**
     * Ajax delete group from user bookmark
     *
     * @param Group $group Group
     * @param Request $request Request
     *
     * @Route("/group/{slug}/bookmark/delete", name="group_delete_from_bookmark")
     * @ParamConverter("group", class="AppBundle:Group")
     *
     * @throws BadRequestHttpException Bab request 400 Request only AJAX
     * @throws UnauthorizedHttpException Forbidden 401 User not authorized
     *
     * @return JsonResponse
     */
    public function ajaxDeleteFromBookmarkAction(Group $group, Request $request)
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

        return new JsonResponse([
            'status'  => true,
            'message' => 'Success',
        ]);
    }

    /**
     * Return genres by group
     *
     * @param Group $group
     *
     * @return Response
     */
    public function genresAction(Group $group)
    {
        $genres = $this->getDoctrine()->getRepository('AppBundle:Genre')->findGenresByGroup($group);

        return $this->render('AppBundle:frontend/group:genres.html.twig', [
            'genres' => $genres
        ]);
    }

    /**
     * Ajax return likes by group
     *
     * @param Group $group Group
     * @param Request $request Request
     *
     * @Route("/group/{slug}/likes", name="group_count_likes")
     * @ParamConverter("group", class="AppBundle:Group")
     *
     * @throws BadRequestHttpException Bab request 400 Request only AJAX
     * @throws UnauthorizedHttpException Forbidden 401 User not authorized
     *
     * @return Response
     */
    public function likesAction(Group $group, Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Не правильний запит');
        }

        if (null === $this->getUser()) {
            throw new UnauthorizedHttpException('Не зареєстрований');
        }

        $countLikes = $this->getDoctrine()->getRepository('AppBundle:Group')->findCountLikesByGroup($group);

        return new JsonResponse([
            'status'  => true,
            'message' => $countLikes[0]['likes'],
        ]);
    }
}
