<?php

namespace App\Form;

use App\Entity\LigneFraisHorsForfait;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneFraisHorsForfaitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mois')
            ->add('libelle')
            ->add('date')
            ->add('montant')
            ->add('idVisiteur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LigneFraisHorsForfait::class,
        ]);
    }
}
