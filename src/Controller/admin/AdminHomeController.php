<?php

namespace App\Controller\admin;

use App\Entity\Presentation;
use App\Form\AboutType;
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
     * @Route("/adminAbout/presentation/{id}", name="admin.home.about")
     * @param Presentation $presentation
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function about(Presentation $presentation, Request $request)
    {
        $form = $this->createForm(AboutType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin.home.index');
        }

        return $this->render('admin/home/about.html.twig', [
            'presentation' => $presentation,
            'form' => $form->createView()
        ]);
    }
}