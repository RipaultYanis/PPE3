<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class VAccueilController extends AbstractController
{
    /**
     * @Route("/v/accueil", name="v_accueil")
     */
    public function index()
    {
        $session=new session;
        echo $login;
        
        return $this->render('v_accueil/index.html.twig', [
            'controller_name' => 'VAccueilController',
        ]);
    }
}
