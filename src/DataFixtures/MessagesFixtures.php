<?php

namespace App\DataFixtures;

use App\Entity\Messages;
use App\Entity\Utilisateurs;
//use App\Entity\Contacts;
//use App\Entity\Medias;

use Faker; 
use Faker\Factory;
use Doctrine\ORM\EntityManagerInterface;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Validator\Constraints\DateTime;

class MessagesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
            
        // Liste des messages :
        for ($m = 1; $m < 100; $m++) 
        {
            $messages = new Messages();
            //$expediteur = new Expediteur();
            //$destinataire = new Destinataire();
$utilisateurs = new Utilisateurs();

            $email = $faker->email;

            $messages
            ->setTitreMessage($faker->name)
            ->setDescription($faker->sentence())
            ->setCreerDate(new \DateTime())
            ->setSiMessageLu($faker->sentence())
            ->setExpediteur($utilisateurs)
            ->setDestinataire($utilisateurs);
            
            $manager->persist($messages);
    
       $manager->flush();  
    }   
    }     
}
