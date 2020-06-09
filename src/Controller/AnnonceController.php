<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{


    /**
     * @Route("/annonces", name="annonces")
     * @param AnnonceRepository $repository
     * @return Response
     */

    public function index(AnnonceRepository $repository):Response
    {
        $annonces = $repository->findByDate();

        return $this->render('pages/annonces.html.twig',[
            'annonces' => $annonces
        ]);
    }
}