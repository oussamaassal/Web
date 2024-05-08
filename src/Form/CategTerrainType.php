<?php

namespace App\Form;

use App\Entity\CategTerrain;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class CategTerrainType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le titre ne peut pas être vide']),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'Le titre ne doit pas dépasser {{ limit }} caractères',
                    ]),
                ],
            ])
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'La description ne peut pas être vide']),
                    new Length([
                        'max' => 1000,
                        'maxMessage' => 'La description ne doit pas dépasser {{ limit }} caractères',
                    ]),
                ],
            ])
            ->add('ajouter', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CategTerrain::class,
        ]);
    }
}
