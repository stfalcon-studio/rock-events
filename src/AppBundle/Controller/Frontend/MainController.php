<?php

namespace AppBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MainController
 *
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class MainController extends Controller
{
    /**
     * Homepage
     *
     * @return Response
     *
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->redirectToRoute('admin');
    }
}
