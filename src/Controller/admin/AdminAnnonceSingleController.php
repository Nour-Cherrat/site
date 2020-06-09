<?php

namespace App\Controller\admin;

use App\Entity\Annonce;
use App\Form\AnnonceType;
use App\Repository\AnnonceRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAnnonceSingleController extends AbstractController
{
    /**
     * @var AnnonceRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private  $em;

    public function __construct(AnnonceRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin.annonce.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function index()
    {
        $annonces = $this->repository->findAll();
        return $this->render('admin/annonce/index.html.twig', compact('annonces'));
    }

    /**
     * @Route("/admin/annonce/create", name="admin.annonce.new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */

    public function new(Request $request)
    {
        $annonce = new Annonce();
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($annonce);
            $this->em->flush();
            $this->addFlash('success', 'Bien créé avec succès');
            return $this->redirectToRoute('admin.annonce.index');
        }

        return $this->render('admin/annonce/new.html.twig', [
            'annonce' => $annonce,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/annonce/{id}", name="admin.annonce.edit", methods="GET|POST")
     * @param Annonce $annonce
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function edit(Annonce $annonce, Request $request)
    {
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin.annonce.index');
        }

        return $this->render('admin/annonce/edit.html.twig', [
            'annonce' => $annonce,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/annonce/{id}", name="admin.annonce.delete", methods="DELETE")
     * @param Annonce $annonce
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */

    public function delete(Annonce $annonce, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$annonce->getId(), $request->get('_token')))
        {
            $this->em->remove($annonce);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès');
        }

        return $this->redirectToRoute('admin.annonce.index');
    }


}