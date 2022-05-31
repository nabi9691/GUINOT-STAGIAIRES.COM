<?php

namespace App\Form;

use App\Entity\Utilisateurs;
use App\Entity\Messages;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
// use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
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
                'required' => true,
                'choices' => ["Madame" => "Madame", "Monsieur" => "Monsieur"],
                'multiple' => false,
            ])

            ->add('nom', TextType::class, [
                'label' => 'Votre nom',
                'required' => true
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Votre prénom',
                'required' => true
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
            
            ->add('message_envoyer', EntityType::class, [
                'label' => 'Votre message envoyer :',
                     //'placeholder' => 'Sélectionner',
                     // looks for choices from this entity
                     'class' =>Messages::class,
                     // Sur quelle propriete je fais le choix
                     'choice_label' => 'titre_message',
                     'mapped' => false,

                     // used to render a select box, check boxes or radios
                 // 'multiple' => false,
                    //'expanded' => true,)
    //            'required' => false
            ])
            
            ->add('message_recu', EntityType::class, [
                'label' => 'Votre message reçu :',
                     //'placeholder' => 'Sélectionner',
                     // looks for choices from this entity
                     'class' =>Messages::class,
                     // Sur quelle propriete je fais le choix
                     'choice_label' => 'titre_message',
                     
                     // used to render a select box, check boxes or radios
                     'mapped' => false,

                     // 'multiple' => true,
                    //'expanded' => true,)
    //            'required' => true
            ])
        
            ->add('medias', MediasType::class, [
                'mapped' => false,
                'by_reference' => false,
            ])
                        
            ->add('login', TextType::class, [
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
            
            // ->add('confirmepassword', PasswordType::class, [
                // 'mapped' => false,
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
