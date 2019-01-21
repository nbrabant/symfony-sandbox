<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;

class LuckyController extends AbstractController
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("lucky/number")
     */
    public function number()
    {
        $this->logger->info('We are loggin!');

        $number = random_int(0, 100);

        return $this->render('lucky/number.html.twig', compact('number'));
    }
}
