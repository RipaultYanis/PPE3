<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FicheFrais;
use App\Repository\FicheFraisRepository;

class CAccueilController extends AbstractController
{
    /**
     * @Route("/c/accueil", name="c_accueil")
     */
    public function index()
    {
        $mesFiches=$this->getDoctrine()->getManager()->getRepository(FicheFrais::class)->findAllFrais();
        return $this->render('c_accueil/index.html.twig',array('mesFiches'=>$mesFiches));
        }
}
