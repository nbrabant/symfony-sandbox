<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    /**
     * @Route({
     *  "fr": "/a-propos",
     *  "en": "/about-us",
     * }, name="about_us")
     */
    public function about()
    {
        return $this->render('company/about.html.twig', [
            'controller_name' => 'CompanyController',
        ]);
    }
}
