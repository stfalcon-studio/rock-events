<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Group;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * Frontend UserController
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class UserController extends Controller
{
    /**
     * User future events
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/cabinet", name="user_cabinet_future_events")
     */
    public function futureEventsAction()
    {
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findEventsByUserBookMark($this->getUser());

        return $this->render('@App/frontend/user/future-events.html.twig', [
            'events' => $events,
        ]);
    }

    /**
     * Groups by user
     *
     * @throws UnauthorizedHttpException Forbidden 401 User not authorized
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/cabinet/groups", name="user_cabinet_group")
     */
    public function groupAction()
    {
        if (null === $this->getUser()) {
            throw new UnauthorizedHttpException('Не зареєстрований');
        }
        $groups = $this->getDoctrine()->getRepository('AppBundle:Group')->findGroupsByUser($this->getUser());

        return $this->render('@App/frontend/user/group.html.twig', [
            'groups' => $groups,
        ]);
    }

    /**
     * Genres by user
     *
     * @throws UnauthorizedHttpException Forbidden 401 User not authorized
     *
     * @return Response
     *
     * @Method("GET")
     * @Route("/cabinet/genres", name="user_cabinet_genre")
     */
    public function genreAction()
    {
        if (null === $this->getUser()) {
            throw new UnauthorizedHttpException('Не зареєстрований');
        }
        $genres = $this->getDoctrine()->getRepository('AppBundle:Genre')->findGenresByUser($this->getUser());

        return $this->render('@App/frontend/user/genre.html.twig', [
            'genres' => $genres,
        ]);
    }
}
