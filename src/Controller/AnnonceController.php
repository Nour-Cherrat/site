<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController{

    /**
     * @Route("/Annonces", name="annonces")
     * @return Response
     */

    public function index():Response {

        return $this->render('pages/annonces.html.twig');
    }
}