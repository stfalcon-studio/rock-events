<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Group;
use AppBundle\Entity\UserGroup;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
     * @Method({"GET", "POST"})
     * @Route("/groups", name="group_list")
     */
    public function listAction()
    {
        $groups = $this->getDoctrine()->getRepository('AppBundle:Group')->findAll();
        if(null===$this->getUser()) {
            return $this->render('AppBundle:frontend\group:list.html.twig', [
                'groups' => $groups
            ]);
        }

        $userGroups = $this->getDoctrine()->getRepository('AppBundle:Group')->findGroupsByUser($this->getUser());

        return $this->render('AppBundle:frontend\group:list.html.twig', [
            'groups'     => $groups,
            'userGroups' => $userGroups
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
            'genres' => $genres
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
            'group'  => $group
        ]);
    }

    /**
     * @param Group $group
     *
     * @Route("/group/{slug}/bookmark", name="group_add_to_bookmark")
     * @ParamConverter("group", class="AppBundle:Group")
     *
     * @return RedirectResponse
     */
    public function addToBookmarkAction(Group $group)
    {
        if (null === $this->getUser()) {
            throw new HttpException(401, "Forbidden");
        }

        $user      = $this->getUser();
        $userGroup = (new UserGroup())->setUser($user)->setGroup($group);

        $em = $this->getDoctrine()->getManager();
        $em->persist($userGroup);
        $em->flush();

        return $this->redirectToRoute("group_list");
    }

    /**
     * @param Group $group
     *
     * @Route("/group/{slug}/bookmark/delete", name="group_delete_from_bookmark")
     * @ParamConverter("group", class="AppBundle:Group")
     *
     * @return RedirectResponse
     */
    public function deleteFromBookmarkAction(Group $group)
    {
        if (null === $this->getUser()) {
            throw new HttpException(401, "Forbidden");
        }

        $userGroup = $this->getDoctrine()->getRepository('AppBundle:UserGroup')->findOneBy([
            'user' => $this->getUser(),
            'group' => $group
        ]);

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($userGroup);
        $em->flush();

        return $this->redirectToRoute("group_list");
    }
}