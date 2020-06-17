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
     * @Route("/annonces/{categorie}", name="annonces")
     * @param AnnonceRepository $repository
     * @param $categorie
     * @return Response
     */

    public function index(AnnonceRepository $repository, $categorie):Response
    {
        $annonces = $repository->findByDate($categorie);

        return $this->render('annonce/index.html.twig',[
            'annonces' => $annonces,
            'categorie' => $categorie
        ]);
    }
}