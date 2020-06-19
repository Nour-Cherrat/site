<?php

namespace App\Controller\admin;

use App\Entity\Annonce;
use App\Entity\Filiere;
use App\Form\AnnonceType;
use App\Form\FiliereType;
use App\Repository\AnnonceRepository;
use App\Repository\FiliereRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminFiliereSingleController extends AbstractController
{
    /**
     * @var FiliereRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private  $em;

    public function __construct(FiliereRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/adminFiliere", name="admin.filiere.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function index()
    {
        $filieres = $this->repository->findAll();
        return $this->render('admin/filiere/index.html.twig', compact('filieres'));
    }

    /**
     * @Route("/adminFiliere/filiere/create", name="admin.filiere.new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */

    public function new(Request $request)
    {
        $filiere = new Filiere();
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($filiere);
            $this->em->flush();
            $this->addFlash('success', 'Bien créé avec succès');
            return $this->redirectToRoute('admin.filiere.index');
        }

        return $this->render('admin/filiere/new.html.twig', [
            'filiere' => $filiere,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/adminFiliere/filiere/{id}", name="admin.filiere.edit", methods="GET|POST")
     * @param Filiere $filiere
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function edit(Filiere $filiere, Request $request)
    {
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin.filiere.index');
        }

        return $this->render('admin/filiere/edit.html.twig', [
            'filiere' => $filiere,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/adminFiliere/filiere/{id}", name="admin.filiere.delete", methods="DELETE")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */

    public function delete(Filiere $filiere, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$filiere->getId(), $request->get('_token')))
        {
            $this->em->remove($filiere);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès');
        }

        return $this->redirectToRoute('admin.filiere.index');
    }


}