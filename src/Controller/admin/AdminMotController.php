<?php

namespace App\Controller\admin;

use App\Entity\MotDoyen;
use App\Form\MotType;
use App\Repository\MotDoyenRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminMotController extends AbstractController
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
     * @Route("/adminMotD", name="admin.mot.index")
     * @param MotDoyenRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(MotDoyenRepository $repository)
    {
        $motD = $repository->findAll();

        return $this->render('admin/mot/index.html.twig', compact('motD'));
    }

    /**
     * @Route("/adminAbout/MotD/create", name="admin.mot.new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $motDoyen = new MotDoyen();
        $form = $this->createForm(MotType::class, $motDoyen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($motDoyen);
            $this->em->flush();
            $this->addFlash('success', 'Bien créé avec succès');
            return $this->redirectToRoute('admin.mot.index');
        }

        return $this->render('admin/mot/new.html.twig', [
            'motDoyen' => $motDoyen,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/adminAbout/MotD/{id}", name="admin.mot.edit", methods="GET|POST")
     * @param MotDoyen $motDoyen
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(MotDoyen $motDoyen, Request $request)
    {
        $form = $this->createForm(MotType::class, $motDoyen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin.mot.index');
        }

        return $this->render('admin/mot/edit.html.twig', [
            'motDoyen' => $motDoyen,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/adminAbout/MotD/{id}", name="admin.mot.delete", methods="DELETE")
     * @param MotDoyen $motDoyen
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(MotDoyen $motDoyen, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$motDoyen->getId(), $request->get('_token')))
        {
            $this->em->remove($motDoyen);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès');
        }

        return $this->redirectToRoute('admin.mot.index');
    }
}