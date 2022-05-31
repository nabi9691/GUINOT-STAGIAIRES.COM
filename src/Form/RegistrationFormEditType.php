<?php

namespace App\Form;

use App\Entity\Utilisateurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
// use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('formation', ChoiceType::class, [
            'label' => 'Votre formation :',
            'required' => true,
            'choices' => ["PINFO" => "PINFO", "DA" => "DA", "PREPA" => "PREPA", "CRCD" => "CRCD", "EAA" => "EAA", "DWWM" => "DWWM", "PMTA" => "PMTA", "AAI" => "AAI"],
            'multiple' => false,
        ])
        
        ->add('civilite', ChoiceType::class, [
                'label' => 'Votre civilité',
                'required' => false,
                'choices' => ["Madame" => "Madame", "Monsieur" => "Monsieur"],
                'multiple' => false,
            ])

            ->add('nom', TextType::class, [
                'label' => 'Votre nom',
                'required' => false
            ])
            
            ->add('prenom', TextType::class, [
                'label' => 'Votre prénom',
                'required' => false
            ])
            ->add('dateDeNaissance', BirthdayType::class, [
                'label' => 'Votre date de Naissance',
                'required' => false,
                'widget' => 'single_text'
            ])

            ->add('adresse', TextType::class, [
                'label' => 'Votre adresse :',
                'required' => true
            ])
            
            ->add('villes', TextType::class, [
                'label' => 'Votre ville :',
                'required' => true
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Votre téléphone :',
                'required' => true
            ])

                // 'mapped' => false,
            

            ->add('login', EmailType::class, [
                'label' => 'Votre login',
                'required' => false
            ])
            ->add('password', PasswordType::class, [
                 'mapped' => false,
                'required' => true,
                'label' => 'Entrez votre mot de passe',
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'minMessage' => 'ça suffit {{ limit }} caractères !',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ]
            ])
            
            //     'required' => true,
            //     'label' => 'Confirmez votre mot de passe',
            // ])
//            ->add('email', EmailType::class, [
//                'label' => 'Votre email'
//            ])
            // ->add('plainPassword', PasswordType::class, [
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            //     'mapped' => false,
            //     'attr' => ['autocomplete' => 'new-password'],
            //     'constraints' => [
            //         new NotBlank([
            //             'message' => 'Please enter a password',
            //         ]),
//                     new Length([
//                         'min' => 6,
//                         'minMessage' => 'Your password should be at least {{ limit }} characters',
//                         // max length allowed by Symfony for security reasons
//                         'max' => 4096,
//                     ]),
            //     ],
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }
}
