<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FicheFrais;
use App\Entity\FraisForfait;
use App\Form\FicheFraisType;
use App\Form\FraisForfaitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class VSaisirFicheFraisController extends AbstractController
{
    /**
     * @Route("/v/saisir/fiche/frais", name="v_saisir_fiche_frais")
     */
   
public function creerFicheFrais(Request $query)
{
    $session=new Session();
    $login=$session->get('login');;
    $password=$session->get('password');
    $id=$session->get('id');
    $mois=date("Ym");
    echo $mois;
    echo $login.' '.$password;
    
    $newfiche = new FicheFrais();
    $fiche = new FicheFrais();
    $fiche = $this->getDoctrine()->getManager()->getRepository(FicheFrais::class)->getUneFicheFrais($id,$mois);
    $frais = new FraisForfait();
    $form = $this->createForm(FicheFraisType::class, $newfiche);
    $form1 = $this->createForm(FicheFraisType::class, $fiche);
    $form2 = $this->createForm(FraisForfaitType::class, $frais);
    if ($fiche->getId()!=null){
        $form1->handleRequest($query);
        if ($query->isMethod('POST')) {
            if ($form1->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($fiche);
                $em->flush();
                $query->getSession()->getFlashBag()->add('notice', 'Fiche enregistrer enregistré.');
                return $this->render('v_modifier_fiche_frais/index.html.twig',array('form1'=>$form1->createView(),'form2'=>$form2->createView()));  
            }
        }
        $form2->handleRequest($query);
        if ($query->isMethod('POST')) {
        // On vérifie que les valeurs entrées sont correctes
            if ($form2->isValid()) {
            // On enregistre notre objet $advert dans la base de données, par exemple
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($frais);
                    $em->flush();
                    $query->getSession()->getFlashBag()->add('notice', 'Fiche enregistrer enregistré.');
            // On redirige vers la page de visualisation du candidat créé
             return $this->render('v_modifier_fiche_frais/index.html.twig',array('form1'=>$form1->createView(),'form2'=>$form2->createView()));  
            }
        }
        return $this->render('v_modifier_fiche_frais/index.html.twig',array('form1'=>$form1->createView(),'form2'=>$form2->createView()));  

    }
    else{
         $form->handleRequest($query);
            if ($query->isMethod('POST')) {
                echo $login.' '.$password;
                if ($form->isValid()) {
                    echo $login.' '.$password;
                   $em = $this->getDoctrine()->getManager();
                   $em->persist($newfiche);
                   $em->flush();
                   $query->getSession()->getFlashBag()->add('notice', 'Candidat enregistré.');
                   return $this->render('v_saisir_fiche_frais/index.html.twig',array('form'=>$form->createView(),'form2'=>$form2->createView()));
                }
            }
        return $this->render('v_saisir_fiche_frais/index.html.twig',array('form'=>$form->createView(),'form2'=>$form2->createView()));
    }        
    return $this->render('v_saisir_fiche_frais/index.html.twig',array('form'=>$form->createView(),'form1'=>$form1->createView(),'form2'=>$form2->createView()));  
}
}

