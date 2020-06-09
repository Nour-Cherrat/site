<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceSingleController extends AbstractController
{
    /**
     * @var AnnonceRepository
     */
    private $repository;

    public function __construct(AnnonceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/annonceSingle", name="annonce.index")
     * @return Response
     */

    public function index():Response
    {
        return $this->render('annonce/index.html.twig', [
            'current_menu' => 'annonces'
        ]);
    }

    /**
     * @Route("/annonceSingle/{slug}-{id}", name="annonce.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show($slug, $id):Response
    {
        $annonce = $this->repository->find($id);

        return $this->render('annonce/show.html.twig', [
            'annonce' => $annonce,
            'current_menu' => 'annonces'
        ]);
    }
}