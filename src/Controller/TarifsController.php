<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Entity\Tarifs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TarifsRepository;

class TarifsController extends AbstractController
{
    /**
     * @Route("/expertise", name="app_tarifs")
     */
    public function index(TarifsRepository $tarifsRepository): Response
    {
        $tarifss = $tarifsRepository->findAll();
        return $this->render('tarifs/index.html.twig', compact('tarifss'));
    }


    /**
     * @Route("/tarifs/{id<[0-9]+>}", name="app_tarifs_show", methods="GET")
     */
    public function show(Tarifs $tarifs) : Response
    {
        return $this->render('tarifs/show.html.twig', compact('tarifs'));
    }
}
