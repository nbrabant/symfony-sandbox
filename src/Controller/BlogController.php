<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * Matches /blog exactily
     *
     * @Route("/blog", name="blog_list")
     */
    public function list()
    {
        return $this->render('blog/list.html.twig', [
            'controller_name' => 'BlogController',
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
