<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FicheFrais;
use App\Repository\FicheFraisRepository;

class VmesFichesFraisController extends AbstractController
{
    /**
     * @Route("/v/mes/fiches/frais", name="vmes_fiches_frais")
     */
    public function index()
    {
      
        $mesFiches=$this->getDoctrine()->getManager()->getRepository(FicheFrais::class)->findAllFrais();
        return $this->render('vmes_fiches_frais/index.html.twig',array('mesFiches'=>$mesFiches));
    }
}
