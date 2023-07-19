<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Matiere;
use App\Entity\Produit;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Count;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                // key => value
                // key : nom de l'option
                // value : valeur de l'option
                'label' => 'Titre du produit',
                
                'attr' => [
                    'placeholder' => 'Saisir le titre du produit',
                    'class' => 'border border-success'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ],
                'help' => 'Le titre doit être compris entre 5 et 30 caractères',
                'help_attr' => [
                    'class' => 'text-warning'
                ],
                'row_attr' => [
                    'class' => 'border border-dark my-4 p-3'
                ],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir le titre du produit'
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 30,
                        'minMessage' => 'Le titre doit comprendre plus de 5 caractères',
                        'maxMessage' => 'Le titre doit comprendre moins de 30 caractères'
                    ])
                ]

            ])

            ->add('prix', MoneyType::class, [
                //'currency' => 'USD'
                'label' => 'Prix du produit',
                
                'attr' => [
                    'placeholder' => 'Saisir le prix du produit',
                    'class' => 'border border-success'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ],
                'help' => 'Le prix doit être supérieur à zéro',
                'help_attr' => [
                    'class' => 'text-warning'
                ],
                'row_attr' => [
                    'class' => 'border border-dark my-4 p-3'
                ],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir le prix du produit'
                    ]),
                    new Positive([
                        'message' => 'Veuillez saisir un montant strictement supérieur à zéro'
                    ])
                ]
            ])


            
            ->add('description', null, [
                'label' => 'Description du produit (facultive)',
                
                'attr' => [
                    'placeholder' => 'Saisir la description du produit',
                    'class' => 'border border-success',
                    'rows' => 8
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ],
                'help' => 'la description doit comprendre moins de 200 caractères',
                'help_attr' => [
                    'class' => 'text-warning'
                ],
                'row_attr' => [
                    'class' => 'border border-dark my-4 p-3'
                ],
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 200,
                        'maxMessage' => 'La description doit comprendre moins de 200 caractères'
                    ])
                ]
            ])

            ->add('categorie', EntityType::class, [ // EntityType : valeurs viennent d'une table en BDD
                'class' => Categorie::class,        // de quelle table ? quelle Entity ?
                'choice_label' => 'nom',            // Afficher dans l'option quelle propriété ?
                'placeholder' => 'Saisir une catégorie',
                'required' => false,
                'label' => 'Catégorie',
                //'expanded' => true, radio/checkbox
                //'multiple' => true, // POUR LA RELATION ManyToMany
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une catégorie'
                    ])
                ]
            ])

            ->add('marque', EntityType::class, [
                'class' => Marque::class,
                'choice_label' => 'nom',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une marque'
                    ])
                ], 
                'placeholder' => 'Saisir une marque'
            ])

            ->add('matieres', EntityType::class, [
                'class' => Matiere::class,
                'choice_label' => 'nom',
                'multiple' => true, // OBLIGATOIRE POUR ManyToMany
                'expanded' => true,
                'required' => false,
                'constraints' => [
                    new Count([
                        'min' => 1,
                        'minMessage' => 'Veuillez cocher au moins une matière'
                    ])
                ]
            ])



            ->add('image', FileType::class, [
                'required' => false,
                'mapped' => false
            ])

       
            // ->add('createdAt', null, [
            //     'date_widget' => 'single_text'
            // ])

            //->add('ajouter', SubmitType::class)
        ;

        /*
            Dans le $builder, pour créer un élément dans le formulaire on utilise la méthode add()
            Si la class est rattachée à une Entity le premier argument de la méthode add() est le nom de la propriété dans cette entity

            le 2e argument : class qui définira le Type

            3e argument : tableau des options
                il existe 2 types d'options
                - celles communes à toutes les class (2e argument)
                - celles propres à la class
        */


        /*
            input : type : text checkbox password file color date submit reset radio number hidden email
            textarea
            select
        */
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
