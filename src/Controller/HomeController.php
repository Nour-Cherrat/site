<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     * @param AnnonceRepository $repository
     * @return Response
     */

    public function index(AnnonceRepository $repository):Response
    {
        $annonces = $repository->findByStatus();
        $timeline = $repository->findByEvent();

        $last1 = $repository->findLast(1);
        $last2 = $repository->findLast(2);
        $last3 = $repository->findLast(3);
        $last4 = $repository->findLast(4);

        return $this->render('pages/home.html.twig',[
            'annonces' => $annonces,
            'timeline' => $timeline,
            'last1' => $last1,
            'last2' => $last2,
            'last3' => $last3,
            'last4' => $last4
        ]);
    }
}