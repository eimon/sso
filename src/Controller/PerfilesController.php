<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PerfilesController extends AbstractController
{
    #[Route('/perfiles', name: 'app_perfiles')]
    public function index(): Response
    {
        return $this->render('perfiles/index.html.twig', [
            'controller_name' => 'PerfilesController',
        ]);
    }
}
