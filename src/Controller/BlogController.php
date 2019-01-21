<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
    public function list(Request $request, $page = 1)
    {
        $page = $request->query->get('page', 1);

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
            ),
            'blog_entries' => [
                [
                    'title' => 'My first article',
                    'body' => 'Body of my first article',
                ],
                [
                    'title' => 'My second article',
                    'body' => 'Body of my second article',
                ]
            ]
        ]);
    }

    /**
     * Matches /blog/*
     *
     * @Route("/blog/{slug}", name="blog_show")
     */
    public function show(Request $request, $slug)
    {
        // code...
    }
}
