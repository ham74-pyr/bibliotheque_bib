<?php
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'attr' => [
                    'placeholder' => 'Saisir votre email',
                    'style' => 'color: gris;',
                    'class' => 'border border-success',
                ],
                'label_attr' => [
                    'style' => 'color: green;'
                ],
                
            ])
            ->add('nom',  TextType::class,[
                'attr' => [
                    'placeholder' => 'Saisir votre nom',
                    'class' => 'border border-success',
                    'style' => 'color: gris;'
                ],
                'label_attr' => [
                    'style' => 'color: green;'
                ],
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saisir votre nom',
                    ]),
                ]
            ])
            ->add('prenom',  TextType::class,[
                'attr' => [
                    'placeholder' => 'Saisir votre prénom',
                    'class' => 'border border-success',
                    'style' => 'color: gris;'
                ],
                'label_attr' => [
                    'style' => 'color: green;'
                ],
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saisir votre prénom',
                    ]),
                ]
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                    
                ],
                'help' => 'agree to our terms',
                'help_attr' => [
                    'class' => 'text-primary'
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
              
                'label_attr' => [
                    'style' => 'color: green;'
                ],
                
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password','placeholder' => 'Saisir votre password',
                    'class' => 'border border-success',
                    'style' => 'color: gris;'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
