<?php

namespace App\Controller;

use App\Repository\AlumniRepository;
use App\Repository\MotDoyenRepository;
use App\Repository\PresentationRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{

    /**
     * @var PresentationRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/about", name="about")
     * @param PresentationRepository $repository
     * @param AlumniRepository $alumniRepository
     * @return Response
     */

    public function index(PresentationRepository $repository, AlumniRepository $alumniRepository):Response
    {
        $present = $repository->findLast();
        $alumnis = $alumniRepository->findLast();

        return $this->render('pages/about.html.twig',[
            'present' => $present,
            'alumnis' => $alumnis
        ]);
    }

    /**
     * @Route("/motDoyen", name="motDoyen")
     * @param MotDoyenRepository $repository
     * @return Response
     */

    public function index2(MotDoyenRepository $repository):Response
    {
        $mot = $repository->findLast();

        return $this->render('pages/motDoyen.html.twig',[
            'mot' => $mot
        ]);
    }
}