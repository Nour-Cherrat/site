<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     * @return Response
     */

    public function index(AnnonceRepository $repository):Response
    {
        $annonces = $repository->findByStatus();

        return $this->render('pages/home.html.twig',[
            'annonces' => $annonces
        ]);
    }
}