<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TcController extends AbstractController{

    /**
     * @Route("/tronc_commun", name="TC")
     * @return Response
     */

    public function index():Response {

        return $this->render('pages/troncCommun.html.twig');
    }
}