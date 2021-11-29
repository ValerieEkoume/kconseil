<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Entity\Tarifs;
use App\Form\BlogType;
use App\Form\TarifsType;
use App\Repository\BlogRepository;
use App\Repository\TarifsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @var BlogRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(BlogRepository $repository, EntityManagerInterface $em)
    {

        $this->repository=$repository;
        $this->em=$em;
    }



    /**
     * @Route("/admin", name="app_admin")
     *
     */
    public function index(): Response
    {
        $blogs = $this->repository->findAll();
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('admin/index.html.twig', compact('blogs'));
    }
    /**
     * @Route("/admin-blog", name="app_admin_blog")
     *
     */
    public function blog(): Response
    {
        $blogs = $this->repository->findAll();
        return $this->render('admin/adminblog.html.twig', compact('blogs'));
    }

    /**
     * @Route("/blogs/create", name="app_blogs_create")
     *
     */
    public function create(Request $request)
    {
        $blog = new Blog();
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($blog);
            $this->em->flush();
            $this->addFlash('success', 'Article créée avec succès');
            return $this->redirectToRoute('app_admin_blog');
        }
        return $this->render('blogs/create.html.twig', [
            'blog' => $blog,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/blogs/{id<[0-9]+>}/edit", name="app_blogs_edit", methods= {"GET", "POST"})
     *
     * @param Blog $blog
     * @return \Symfony\component\HttpFoundation\Response
     */
    public function edit(Blog $blog, Request $request)
    {
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Leçon modifiée avec succès');
            return $this->redirectToRoute('app_admin_blog');
        }

        return $this->render('blogs/edit.html.twig', [
            'blog' => $blog,
            'form' => $form->createView()
        ]);
    }

    /**
     *  @Route("/admin/blogs/delete/{id}", name="app_blogs_delete", methods="POST")
     * @param Blog $blog
     * @return \Symfony\component\HttpFoundation\Response
     */
    public function delete(Blog $blog, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $blog->getId(), $request->get('token')))  {
            $this->em->remove($blog);
            $this->em->flush();
            $this->addFlash('success', 'Leçon supprimée avec succès');

        }
        return $this->redirectToRoute('app_admin_blog');


    }

    /**
     * @Route("/admin-tarif", name="app_admin_tarif")
     */
    public function tarif(TarifsRepository $tarifsRepository): Response
    {
        $tarifss = $tarifsRepository->findAll();
        return $this->render('admin/admintarif.html.twig', compact('tarifss'));
    }

    /**
     * @Route("/tarifs/new", name="app_tarifs_new")
     */
    public function new(Request $request)
    {
        $tarif = new Tarifs();
        $form = $this->createForm(TarifsType::class, $tarif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($tarif);
            $this->em->flush();
            $this->addFlash('success', 'Article créée avec succès');
            return $this->redirectToRoute('app_admin_tarif');
        }
        return $this->render('tarifs/new.html.twig', [
            'tarif' => $tarif,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/tarifs/{id<[0-9]+>}/modif", name="app_tarifs_modif", methods= {"GET", "POST"})
     * @param Tarifs $tarifs
     * @return \Symfony\component\HttpFoundation\Response
     */
    public function modif(Tarifs $tarifs, Request $request)
    {
        $form = $this->createForm(TarifsType::class, $tarifs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Leçon modifiée avec succès');
            return $this->redirectToRoute('app_admin_tarif');
        }

        return $this->render('tarifs/modif.html.twig', [
            'tarifs' => $tarifs,
            'form' => $form->createView()
        ]);
    }


    /**
     *  @Route("/admin/tarifs/supprime/{id}", name="app_tarifs_supprime", methods="POST")
     * @param Tarifs $tarifs
     * @return \Symfony\component\HttpFoundation\Response
     */
    public function supprime(Tarifs $tarifs, Request $request)
    {
        if ($this->isCsrfTokenValid('supprime' . $tarifs->getId(), $request->get('token'))) {
            $this->em->remove($tarifs);
            $this->em->flush();
            $this->addFlash('success', 'Leçon supprimée avec succès');

        }
        return $this->redirectToRoute('app_admin_tarif');


    }



}
