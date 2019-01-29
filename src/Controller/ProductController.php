<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);

        $products = $repository->findAll();

        return $this->render('product/index.html.twig', [
            'title' => 'Product list',
            'controller_name' => 'ProductController',
            'product_entries' => $products,
        ]);
    }

    /**
     * @Route("/product/new", name="product_new")
     */
    public function new(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(1999);
        $product->setDescription('Ergonomic keyboard with unicorn layout');

        $entityManager->persist($product);

        $entityManager->flush();

        return new Response('Saved new product with id ' . $product->getId());
    }

    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function show($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id ' . $id);
        }

        return new Response('Check out this great product : ' . $product->getName());
    }
}
