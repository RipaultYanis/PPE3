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
    echo $login.' '.$password;
    //$id=$this->getDoctrine()->getManager()->getRepository(FicheFrais::class)->getIdVisiteur($login,$password);
    echo $id;
// On crée un objet
        $fiche = new FicheFrais();
        $fiche = $this->getDoctrine()->getManager()->getRepository(FicheFrais::class)->getUneFicheFrais($id);
        $frais = new FraisForfait();


        $form2 = $this->createForm(FraisForfaitType::class, $frais);

//Créer un objet de type formulaire
$form1 = $this->createForm(FicheFraisType::class, $fiche);
$form2 = $this->createForm(FraisForfaitType::class, $frais);

// On fait le lien Requête HTTP <-> Formulaire
// À partir de maintenant, la variable $categ contient les valeurs entrée dans le formulaire

$form1->handleRequest($query);
        if ($query->isMethod('POST')) {
        // On vérifie que les valeurs entrées sont correctes
        if ($form1->isValid()) {
        // On enregistre notre objet $advert dans la base de données, par exemple
                $em = $this->getDoctrine()->getManager();
                $em->persist($fiche);
                $em->flush();
                $query->getSession()->getFlashBag()->add('notice', 'Fiche enregistrer enregistré.');
        // On redirige vers la page de visualisation du candidat créé
         return $this->render('v_saisir_fiche_frais/index.html.twig',array('form1'=>$form1->createView(),'form2'=>$form2->createView()));  
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
         return $this->render('v_saisir_fiche_frais/index.html.twig',array('form1'=>$form1->createView(),'form2'=>$form2->createView()));  
        }
        }
        // Erreur dans le formulaire => retour vers ce dernier        
        return $this->render('v_saisir_fiche_frais/index.html.twig',array('form1'=>$form1->createView(),'form2'=>$form2->createView()));  

}
}
