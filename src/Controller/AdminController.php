<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
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
     */
    public function index(): Response
    {
        $blogs = $this->repository->findAll();
        return $this->render('admin/index.html.twig', compact('blogs'));
    }

    /**
     * @Route("/blogs/create", name="app_blogs_create")
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
            return $this->redirectToRoute('app_admin');
        }
        return $this->render('blogs/create.html.twig', [
            'blog' => $blog,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/blogs/{id<[0-9]+>}/edit", name="app_blogs_edit", methods= {"GET", "POST"})
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
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('blogs/edit.html.twig', [
            'blog' => $blog,
            'form' => $form->createView()
        ]);
    }

    /**
     *  @Route("/admin/couts/delete/{id}", name="app_blogs_delete", methods="DELETE")
     * @param Blog $blog
     * @return \Symfony\component\HttpFoundation\Response
     */
    public function delete(Blog $blog, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $blog->getId(), $request->get('token'))) {
            $this->em->remove($blog);
            $this->em->flush();
            $this->addFlash('success', 'Leçon supprimée avec succès');

        }
        return $this->redirectToRoute('app_admin');


    }


}
