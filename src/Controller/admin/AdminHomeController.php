<?php

namespace App\Controller\admin;

use App\Entity\MotDoyen;
use App\Entity\Presentation;
use App\Form\AboutType;
use App\Form\MotType;
use App\Repository\PresentationRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminHomeController extends  AbstractController
{
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }


    /**
     * @Route("/adminAbout", name="admin.home.index")
     * @param PresentationRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PresentationRepository $repository)
    {
        $present = $repository->findAll();
        
        return $this->render('admin/home/index.html.twig', compact('present'));
    }

    /**
     * @Route("/adminAbout/presentation/create", name="admin.home.new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $presentation = new Presentation();
        $form = $this->createForm(AboutType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($presentation);
            $this->em->flush();
            $this->addFlash('success', 'Bien créé avec succès');
            return $this->redirectToRoute('admin.home.index');
        }

        return $this->render('admin/home/new.html.twig', [
            'presentation' => $presentation,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/adminAbout/presentation/{id}", name="admin.home.edit", methods="GET|POST")
     * @param Presentation $presentation
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Presentation $presentation, Request $request)
    {
        $form = $this->createForm(AboutType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin.home.index');
        }

        return $this->render('admin/home/edit.html.twig', [
            'presentation' => $presentation,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/adminAbout/presentation/{id}", name="admin.home.delete", methods="DELETE")
     * @param Presentation $presentation
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Presentation $presentation, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$presentation->getId(), $request->get('_token')))
        {
            $this->em->remove($presentation);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès');
        }

        return $this->redirectToRoute('admin.home.index');
    }

}