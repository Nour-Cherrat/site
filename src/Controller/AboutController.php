<?php

namespace App\Controller;

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
     * @return Response
     */

    public function index(PresentationRepository $repository):Response
    {
        $present = $repository->find(1);

        return $this->render('pages/about.html.twig',[
            'present' => $present
        ]);
    }

    /**
     * @Route("/motDoyen", name="motDoyen")
     * @return Response
     */

    public function index2():Response
    {
        return $this->render('pages/motDoyen.html.twig');
    }
}