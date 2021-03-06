<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use App\Entity\Category;

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
        $category = new Category();
        $category->setName('Junk food');

        $product = new Product();
        $product->setName('Knackkis');
        $product->setPrice(2);
        $product->setDescription('Industrial saussages');

        $product->setCategory($category);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($category);
        $entityManager->persist($product);
        $entityManager->flush();

        return new Response(
            'Saved new product with id ' . $product->getId() . '
             and new category with id ' . $category->getId());
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

    /**
     * @Route("/product/edit/{id}", name="product_edit")
     */
    public function edit($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException('No product for id ' . $id);
        }

        $product->setName('New product name');
        $entityManager->flush();

        return $this->redirectToRoute('product_show', [
            'id' => $product->getId(),
        ]);
    }

    /**
     * @Route("/product/delete/{id}", name="product_delete")
     */
    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException('No product for id ' . $id);
        }

        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('product');
    }
}
