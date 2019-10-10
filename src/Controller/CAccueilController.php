<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CAccueilController extends AbstractController
{
    /**
     * @Route("/c/accueil", name="c_accueil")
     */
    public function index()
    {
        return $this->render('c_accueil/index.html.twig', [
            'controller_name' => 'CAccueilController',
        ]);
    }
}
