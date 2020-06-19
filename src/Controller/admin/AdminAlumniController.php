<?php

namespace App\Controller\admin;

use App\Entity\Alumni;
use App\Form\AlumniType;
use App\Repository\AlumniRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminAlumniController extends AbstractController
{
    /**
     * @var AlumniRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private  $em;

    public function __construct(AlumniRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/adminAlumni", name="admin.alumni.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function index()
    {
        $alumnis = $this->repository->findAll();
        return $this->render('admin/alumni/index.html.twig', compact('alumnis'));
    }

    /**
     * @Route("/adminAlumni/alumni/create", name="admin.alumni.new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */

    public function new(Request $request)
    {
        $alumni = new Alumni();
        $form = $this->createForm(AlumniType::class, $alumni);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($alumni);
            $this->em->flush();
            $this->addFlash('success', 'Bien créé avec succès');
            return $this->redirectToRoute('admin.alumni.index');
        }

        return $this->render('admin/alumni/new.html.twig', [
            'alumni' => $alumni,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/adminAlumni/alumni/{id}", name="admin.alumni.edit", methods="GET|POST")
     * @param Alumni $alumni
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function edit(Alumni $alumni, Request $request)
    {
        $form = $this->createForm(AlumniType::class, $alumni);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin.alumni.index');
        }

        return $this->render('admin/alumni/edit.html.twig', [
            'alumni' => $alumni,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/adminAlumni/alumni/{id}", name="admin.alumni.delete", methods="DELETE")
     * @param Alumni $alumni
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */

    public function delete(Alumni $alumni, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$alumni->getId(), $request->get('_token')))
        {
            $this->em->remove($alumni);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès');
        }

        return $this->redirectToRoute('admin.alumni.index');
    }


}