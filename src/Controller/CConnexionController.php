<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AuthentificationType;
use App\Entity\Comptable;
use App\Entity\Visiteur;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use App\Repository\ComptableRepository;
use Symfony\Component\HttpFoundation\Session\Session;

class CConnexionController extends AbstractController
{
   
  
    /**
     * @Route("/connexion", name="c_connexion")
     */
   public function authentifAction(Request $query) {
       $session=new session();
        $login = $password = null;
        $form = $this->get('form.factory')->createBuilder(FormType::class)
                ->add('login',TextType::class,array('label'=>'Login :','attr'=>array('class'=>'form-control','placeholder'=>'login...')))
                ->add('mdp',PasswordType::class,array('label'=>'Mot de Passe :','attr'=>array('class'=>'form-control','placeholder'=>'mot de passe...')))
                ->add('valider',SubmitType::class,array('label'=>'Valider','attr'=>array('class'=>'btn btn-primary btn block')))
                ->add('annuler',ResetType::class,array('label'=>'Effacer','attr'=>array('class'=>'btn btn-primary btn block')))
                ->getForm();

        if ($query->isMethod('POST')) {
        $form->handleRequest($query);
        }
        if ( $form->isSubmitted() && $form->isValid()) {
        $data = $form->getData();

        $login = $data["login"];
        $password = $data["mdp"]; 
        $erreur="Login ou Mot de passe incorect";
        $comptables=$this->getComptable();
        $visiteurs=$this->getVisiteur();
        foreach ($comptables as $comp) {
             if ($comp->getLogin()==$login && $comp->getMdp()==$password){
                $session->set('nom',$comp->getNom());
                $session->get('nom');
                $session->set('prenom',$comp->getPrenom());
                $session->get('prenom');
                
                
                 return $this->render('c_accueil/index.html.twig',array('form'=>$form->createView())); 
            
        }
        }
        foreach ($visiteurs as $visit) {
             if ($visit->getLogin()==$login && $visit->getMdp()==$password){
                $session->set('nom',$visit->getNom());
                $session->get('nom');
                $session->set('prenom',$visit->getPrenom());
                $session->get('prenom');
                 return $this->render('v_accueil/index.html.twig',array('form'=>$form->createView())); 
            
        }
            
        }$session->getFlashBag()->add('notice','Login ou Mot de passe incorrect');
        foreach ($session->getFlashBag()->get('notice',[])as $message){
            echo '<div>'.$message.'</div>';
        }
        }
        return $this->render('c_connexion/index.html.twig',array('form'=>$form->createView(),'login'=>$login,'password'=>$password));

  
}
  public function getComptable(){
   $repository = $this->getDoctrine()->getManager()->getRepository(\App\Entity\Comptable::class);
    $listeCandidats = $repository->findAll();
    return $listeCandidats;
}
 public function getVisiteur(){
   $repository = $this->getDoctrine()->getManager()->getRepository(\App\Entity\Visiteur::class);
    $listeCandidats = $repository->findAll();
    return $listeCandidats;
}

}