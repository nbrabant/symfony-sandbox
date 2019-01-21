<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * Matches /blog exactily
     *
     * @Route(
     *      "/blog/{page}",
     *      name="blog_list",
     *      requirements={
     *          "page"="\d+",
     *          "_format": "html|rss"
     *      }
     * )
     */
    public function list($page = 1)
    {
        return $this->render('blog/list.html.twig', [
            'controller_name' => 'BlogController',
            'page' => $page,
            'prev' => $this->generateUrl(
                'blog_list',
                ['page' => ($page <= 1 ? 1 : $page - 1)]
            ),
            'next' => $this->generateUrl(
                'blog_list',
                ['page' => $page + 1]
            )
        ]);
    }

    /**
     * Matches /blog/*
     *
     * @Route("/blog/{slug}", name="blog_show")
     */
    public function show($slug)
    {
        // code...
    }
}
