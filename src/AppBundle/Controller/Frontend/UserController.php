<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Group;
use AppBundle\Entity\RequestManager;
use AppBundle\Entity\RequestManagerGroup;
use AppBundle\Form\Entity\RequestManager as RequestManagerForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * Frontend UserController
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class UserController extends Controller
{
    /**
     * User future events
     *
     * @return Response
     *
     * @Route("/cabinet", name="user_cabinet")
     */
    public function userCabinetAction()
    {
        return $this->render('AppBundle:frontend/user:dashboard.html.twig');
    }

    /**
     * User future events
     *
     * @return Response
     *
     * @Route("/cabinet/future-event", name="user_cabinet_future_events")
     */
    public function futureEventsAction()
    {
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findEventsByUserBookMark($this->getUser());

        return $this->render('AppBundle:frontend/user:future-events.html.twig', [
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
     * @Route("/cabinet/groups", name="user_cabinet_group")
     */
    public function groupAction()
    {
        if (null === $this->getUser()) {
            throw new UnauthorizedHttpException('Не зареєстрований');
        }

        $groups = $this->getDoctrine()->getRepository('AppBundle:Group')->findGroupsByUser($this->getUser());

        return $this->render('AppBundle:frontend/user:group.html.twig', [
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
     * @Route("/cabinet/genres", name="user_cabinet_genre")
     */
    public function genreAction()
    {
        if (null === $this->getUser()) {
            throw new UnauthorizedHttpException('Не зареєстрований');
        }

        $genres = $this->getDoctrine()->getRepository('AppBundle:Genre')->findGenresByUser($this->getUser());

        return $this->render('AppBundle:frontend/user:genre.html.twig', [
            'genres' => $genres,
        ]);
    }

    /**
     * Request on granting rights manager
     *
     * @param Request $request Request
     *
     * @throws UnauthorizedHttpException Forbidden 401 User not authorized
     *
     * @return Response
     *
     * @Route("/cabinet/request-manager", name="user_request_manager")
     */
    public function requestRightManagerAction(Request $request)
    {
        $user = $this->getUser();

        if (null === $user) {
            throw new UnauthorizedHttpException('Не зареєстрований');
        }

        $form = $this->createForm('request_manager', null, [
            'action' => $this->generateUrl('user_request_manager'),
        ]);
        $form->handleRequest($request);

        if ($form->isValid()) {

            /** @var RequestManagerForm $requestManagerForm */
            $requestManagerForm = $form->getData();

            $userService = $this->get('app.user');
            $userService->saveRequestRightManager($requestManagerForm, $user);

            return $this->redirectToRoute('user_cabinet');
        }

        return $this->render('AppBundle:frontend/user:request-manager.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
