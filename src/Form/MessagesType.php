<?php

namespace App\Form;

use App\Entity\Contacts;
use App\Entity\Messages;
use App\Entity\Medias;

use App\Entity\Utilisateurs;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
//use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MessagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
        ->add('titre_message', TextType::class, [
            'label' => 'Le titre de votre message !',
            'attr' => ['placeholder' => 'Titre'],
                'constraints' => [
                    new Length([
                    'min' => 2 ,
                    'max' => 20
                ]),
                    new NotBlank([
                        'message' => 'Entrez votre titre',
                    ]),
                ],
                'required' => true
        ])
            
        ->add('description' ,
                    TextareaType::class,[
                'label' =>'Description de votre message !' ,
                'attr' => ['placeholder' => 'Description'],
                'constraints' => [
                    new Length([
                    'min' => 2 ,
                    'max' => 700
                ]),
                    new NotBlank([
                        'message' => 'Entrez votre description',
                    ]),
                ],
'required' => true
        ])
        
        ->add('creer_date', BirthdayType::class, [
            'label' => 'Date cr"ation du message :',
            'required' => false,
            'widget' => 'single_text'
        ])

        ->add('si_messageLu', TextType::class, [
            'label' => 'Si le message est lu :',
            'required' => false
        ])
        
        ->add('expediteur', EntityType::class, [
            'label' =>'Expéditeur du message :',
                 //'placeholder' => 'Sélectionner',
                 // looks for choices from this entity
                 'class' =>Messages::class,
                 // Sur quelle propriete je fais le choix
                 'choice_label' => 'titre_message',
                 
                 // used to render a select box, check boxes or radios
             // 'multiple' => false,
                //'expanded' => true,)
//            'required' => false
        ])
        
        ->add('destinataire', EntityType::class, [
            'label' =>'Destinataire du message :',
                 //'placeholder' => 'Sélectionner',
                 // looks for choices from this entity
                 'class' =>Messages::class,
                 // Sur quelle propriete je fais le choix
                 'choice_label' => 'titre_message',
                 
                 // used to render a select box, check boxes or radios
             // 'multiple' => true,
                //'expanded' => true,)
//            'required' => true
        ])
        

        ;
        }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Messages::class,
        ]);
    }
}
