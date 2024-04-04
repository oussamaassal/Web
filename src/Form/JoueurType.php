<?php

namespace App\Form;

use App\Entity\Joueur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class JoueurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'required' => false
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'required' => false
            ])
            ->add('age', IntegerType::class, [
                'label' => 'Âge',
                'required' => false
            ])
            ->add('position', ChoiceType::class, [
                'label' => 'Position',
                'choices' => [
                    'GK' => 'GK',
                    'DC' => 'DC',
                    'AL' => 'AL',
                    'MD' => 'MD',
                    'MC' => 'MC',
                    'MO' => 'MO',
                    'AD' => 'AD',
                    'AG' => 'AG',
                    'AP' => 'AP',
                    'SA' => 'SA',
                ],
                'placeholder' => 'Select Position', 
                'expanded' => false, 
                'multiple' => false, 
                'required' => false
            ])
            ->add('hauteur', IntegerType::class, [
                'label' => 'Hauteur',
                'required' => false
            ])
            ->add('poids', IntegerType::class, [
                'label' => 'Poids',
                'required' => false
            ])
            ->add('piedfort', ChoiceType::class, [
                'label' => 'Pied fort',
                'expanded' => true,
                'choices' => [
                    'Pied Gauche' => 'Gauche',
                    'Pied Droite' => 'Droite',
                ],
                'required' => false,
                'placeholder' => false, 

                
            ])
            ->add('imagepath', FileType::class, [
                'label' => false,
                'mapped' => false,
                'required' => false, 
            ])
            ->add('link', TextType::class, [
                'label' => 'Lien',
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Joueur::class,
        ]);
    }
}
