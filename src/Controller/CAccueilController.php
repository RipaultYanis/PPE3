<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FicheFrais;
use App\Entity\FraisForfait;
use App\Form\FicheFraisType;
use App\Form\FraisForfaitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class CAccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function afficherVisite(Request $query){
        $session= new Session;
        $fiche = new FicheFrais();
        $form1 = $this->createForm(FicheFraisType::class, $fiche);
        $form1->handleRequest($query);
        if ($query->isMethod('POST')) {
        // On vérifie que les valeurs entrées sont correctes
        if ($form1->isValid()) {
        // On enregistre notre objet $advert dans la base de données, par exemple
                $em = $this->getDoctrine()->getManager();
                $em->persist($fiche);
                $em->flush();
                $query->getSession()->getFlashBag()->add('notice', 'Fiche enregistrer enregistré.');
        $mesFiches=$this->getDoctrine()->getManager()->getRepository(FicheFrais::class)->findAllFrais();
        return $this->render('c_accueil/index.html.twig',array('mesFiches'=>$mesFiches,'form1'=>$form1->createView()));
    }
        }
        return new Response('test');
        }
}
    