<?php

namespace App\Form;

use App\Entity\FicheFrais;
use App\Entity\Etat;
use App\Entity\Visiteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FicheFraisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mois',TextType::class,array('label'=>'Mois : ','attr'=>array('class'=>'form-control','placeholder'=>'aaaamm')))
            ->add('nbJustificatifs',NumberType::class,array('label'=>'Nombre de Justificatifs : ','attr'=>array('class'=>'form-control')))
            ->add('montantValide',NumberType::class,array('label'=>'Montant Validé','attr'=>array('class'=>'form-control','placeholder'=>'montant...')))
            ->add('dateModif',DateType::class,array('label'=>'Date de Modification :','attr'=>array('class'=>'form-control')))
            ->add('idVisiteur',EntityType::class,array('class'=>Visiteur::class,'choice_label'=>'nom'))
            ->add('idEtat',EntityType::class,array('class'=> Etat::class,'choice_label'=>'libelle'))
            ->add('valider',SubmitType::class,array('label'=>'Valider','attr'=>array('class'=>'btn btn-primary btn block')))
            ->add('annuler',ResetType::class,array('label'=>'Effacer','attr'=>array('class'=>'btn btn-primary btn block')))
                
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FicheFrais::class,
        ]);
    }
}
