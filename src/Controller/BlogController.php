<?php

namespace App\Controller;

use App\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
            'title' => 'Blog list',
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
     * Matches /blog/new
     *
     * @Route("/blog/new", name="blog_new")
     */
    public function new(Request $request)
    {
        $blog = new Blog();

        $form = $this->createFormBuilder($blog)
            ->add('code', TextType::class)
            ->add('designation', TextareaType::class)
            ->add('publish_at', DateType::class)
            ->add('save', SubmitType::class, ['label' => 'Create blog'])
            ->getForm();

        return $this->render('blog/new.html.twig', [
            'title' => 'Create a new blog',
            'form' => $form->createView(),
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
