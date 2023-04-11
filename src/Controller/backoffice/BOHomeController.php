<?php

namespace App\Controller\backoffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BOHomeController extends AbstractController
{
    #[Route('/backoffice/home', name: 'app_bo_home')]
    public function index(): Response
    {
        return $this->render('backoffice/index.html.twig', [
            'controller_name' => 'BOHomeController',
        ]);
    }
}
