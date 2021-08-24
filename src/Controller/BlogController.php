<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blogs", name="app_blog")
     */
    public function index(BlogRepository $blogRepository): Response
    {
        $blogs = $blogRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('blogs/index.html.twig', compact('blogs'));
    }

    /**
     * @Route("/blogs/{id<[0-9]+>}", name="app_blogs_show")
     */
    public function show(Blog $blog) : Response
    {
        return $this->render('blogs/show.html.twig', compact('blog'));
    }
}
