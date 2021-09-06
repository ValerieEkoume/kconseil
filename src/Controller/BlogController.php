<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{

    /**
     * @Route("/blogs", name="app_blogs", methods="GET")
     */
    public function index(BlogRepository $blogRepository): Response
    {
        $blogs = $blogRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('blogs/index.html.twig', compact('blogs'));
    }

    /**
     * @Route("/blogs/create", name="app_blogs_create", methods={"GET", "POST"})
     */
    public function create(Request $request, EntityManagerInterface $em):Response
    {
        $blog = new Blog;

        $form = $this->createForm(BlogType::class, $blog)

            ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($blog);
            $em->flush();

            $this->addFlash('success', 'L\'article de blog a bien été créé');

            return $this->redirectToRoute('app_blogs');
        }

        return $this->render('blogs/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/blogs/{id<[0-9]+>}", name="app_blogs_show", methods="GET")
     */
    public function show(Blog $blog) : Response
    {
        return $this->render('blogs/show.html.twig', compact('blog'));
    }


    /**
     * @Route("/blogs/{id<[0-9]+>}/edit", name="app_blogs_edit", methods= {"GET", "POST"})
     */
    public function edit(Request $request, EntityManagerInterface $em, Blog $blog):Response
    {
        $form = $this->createForm(BlogType::class, $blog)
          ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'Article modifié avec succès');

            return $this->redirectToRoute('app_blogs');
        }

            return $this->render('blogs/edit.html.twig', [
                'blog'=> $blog,
                'form' => $form->createView()

        ]);
        }

    /**
     * @Route("/blogs/{id<[0-9]+>}/delete", name="app_blogs_delete", methods= {"GET"})
     */
    public function delete(Request $request, EntityManagerInterface $em, Blog $blog):Response
    {

        $em->remove($blog);
        $em->flush();

        $this->addFlash('info', 'Article  supprimé avec succès');

        return $this->redirectToRoute('app_blogs');
    }


}
