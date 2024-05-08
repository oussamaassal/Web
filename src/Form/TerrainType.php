<?php

namespace App\Form;

use App\Entity\CategTerrain;
use App\Entity\Terrain;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\Type;

class TerrainType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_terrain', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le nom du terrain ne peut pas être vide']),
                    new Length(['max' => 255, 'maxMessage' => 'Le nom du terrain ne doit pas dépasser {{ limit }} caractères']),
                ],
            ])
            ->add('adresse', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'L\'adresse ne peut pas être vide']),
                    new Length(['max' => 255, 'maxMessage' => 'L\'adresse ne doit pas dépasser {{ limit }} caractères']),
                ],
            ])
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'La description ne peut pas être vide']),
                    new Length(['max' => 1000, 'maxMessage' => 'La description ne doit pas dépasser {{ limit }} caractères']),
                ],
            ])
            ->add('geo_x', NumberType::class, [

            ])
            ->add('geo_y', NumberType::class, [


            ])

            ->add('ouverture', DateTimeType::class, [
                'required' => false,
                'widget' => 'single_text',

            ])
            ->add('fermeture', DateTimeType::class, [
                'required' => false,
                'widget' => 'single_text',
            ])
            ->add('CategTerrain', EntityType::class, [
                'class' => CategTerrain::class,
                'choice_label' => 'titre',
                'label' => 'Catégorie',
                'constraints' => [
                    new NotBlank(['message' => 'La catégorie ne peut pas être vide']),
                ],
            ])

            ->add('ajouter', SubmitType::class, ['label' => 'Ajouter'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Terrain::class,
        ]);
    }
}
