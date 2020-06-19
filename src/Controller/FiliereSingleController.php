<?php

namespace App\Controller;

use App\Repository\FiliereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FiliereSingleController extends AbstractController
{
    /**
     * @var FiliereRepository
     */
    private $repository;

    public function __construct(FiliereRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/filiereSingle", name="filiere.index")
     * @return Response
     */

    public function index():Response
    {
        return $this->render('filiere/index.html.twig');
    }

    /**
     * @Route("/filiereSingle/{slug}-{id}", name="filiere.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show($slug, $id):Response
    {
        $filiere = $this->repository->find($id);

        return $this->render('filiere/show.html.twig', [
            'filiere' => $filiere
        ]);
    }
}