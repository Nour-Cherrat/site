<?php

namespace App\Controller;

use App\Repository\FiliereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FiliereController extends AbstractController
{


    /**
     * @Route("/filieres/{categorie}", name="filieres")
     * @param FiliereRepository $repository
     * @param $categorie
     * @return Response
     */

    public function index(FiliereRepository $repository, $categorie):Response
    {
        $filieres = $repository->findByCategory($categorie);

        return $this->render('filiere/index.html.twig',[
            'filieres' => $filieres,
            'categorie' => $categorie
        ]);
    }
}