<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VmesFichesFraisController extends AbstractController
{
    /**
     * @Route("/vmes/fiches/frais", name="vmes_fiches_frais")
     */
    public function index()
    {
        return $this->render('vmes_fiches_frais/index.html.twig', [
            'controller_name' => 'VmesFichesFraisController',
        ]);
    }
}
