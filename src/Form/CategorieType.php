<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'label' => 'Nom de la catégorie',
                'attr' => [
                    'placeholder' => 'Saisir le nom de la catégorie'
                ],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir le nom de la catégorie'
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 30,
                        'minMessage' => 'Le nom de la catégorie doit comprendre plus de 5 caractères',
                        'maxMessage' => 'Le nom de la catégorie doit comprendre moins de 30 caractères'
                    ])
                ]
                    ]);
           

    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
