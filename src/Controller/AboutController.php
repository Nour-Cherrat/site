<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController{

    /**
     * @Route("/about", name="about")
     * @return Response
     */

    public function index():Response{

        return $this->render('pages/about.html.twig');
    }

    /**
     * @Route("/motDoyen", name="motDoyen")
     * @return Response
     */

    public function index2():Response
    {
        return $this->render('pages/motDoyen.html.twig');
    }
}