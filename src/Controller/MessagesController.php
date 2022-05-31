<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessagesType;
use App\Repository\MessagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

//use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/messages")
 */
class MessagesController extends AbstractController
{
    /**
     * @Route("/", name="message_index")
     */
    public function index(MessagesRepository $messagesRepository, PaginatorInterface $pagi, Request $request): Response
    {
        $messages = $pagi->paginate(
            $messagesRepository->findWithPagination(),
            $request->query->getInt('page',1),10
                    
        );
        return $this->render('messages/index.html.twig', [
            'message' => $messagesRepository->findAll(),
        ]);
    }
    
/**
     * @Route("/formulaireMessages", name = "formulaireMessages_index", methods={"GET","POST"})
     */
    public function formulaireMessages(Request $request): Response
    {
        $messages = new Messages();
        
        $form = $this->createForm(MessagesType::class, $messages);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($messages);
            $entityManager->flush();
            $this->addFlash("success","La création a été effectuée avec succé !");

            return $this->redirectToRoute('message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('messages/formulaireMessages.html.twig', [
            'message' => $messages,
            'formMessages' => $form->createView(),
        ]);
    }

    /**
     * @Route("/nouveauMessages", name="nouveauMessage_index", methods={"GET","POST"})
     */
    public function nouveauMessages(Request $request): Response
    {
        $messages = new Messages();
        $form = $this->createForm(MessagesType::class, $messages);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($messages);
            $entityManager->flush();
            $this->addFlash("success","Enregistrement nouveau message a été effectuée avec succés !");

            return $this->redirectToRoute('message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('messages/nouveauMessage.html.twig', [
            'message' => $messages,
            'formMessages' => $form->createView(),
        ]);
    }

    /**
     * @Route("/afficherMessage/{id}", name="afficherMessage_index", methods={"GET"})
     */
    public function afficherMessage(Messages $messages): Response
    {
        $this->addFlash("success","Affichage a été effectuée avec succés !");

        return $this->render('messages/afficherMessage.html.twig', [
            'message' => $messages,
        ]);
    }

/**
     * @Route("/modifierMessages/{id}", name="modifierMessage_index", methods={"GET","POST"})
     */
    public function modifierMessages(Request $request, Messages $messages): Response
    {
        $form = $this->createForm(MessagesType::class, $messages);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($messages);
            $entityManager->flush();
            $this->addFlash("success","La modification a été effectuée avec succés !");

            return $this->redirectToRoute('message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('messages/modifierMessage.html.twig', [
            'message' => $messages,
            'formMessages' => $form->createView(),
        ]);
    }

// SUPPRESSION D'UN MESSAGE :
    /**
     * @Route("/supprimerMessages/{id}" , name="supprimerMessage_index", methods= {"GET","POST"})
     */
    public function supprimerMessages(Request $request, Messages $messages , EntityManagerInterface $entityManager) : Response 
    {           
            $entityManager->remove($messages);
            $entityManager->flush();
            $this->addFlash("success","La suppression a été effectuée avec succés !");

            return $this->redirectToRoute('message_index'); 
    }


/**
     * @Route("/messageEnvoyer", name="messageEnvoyer_index")
     */
    public function messageEnvoyer(Request $request, Messages $messages): Response
    {
        $messages = new Messages();
        $form = $this->createForm(MessagesType::class, $messages);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $messages->setExpediteur($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($messages);
            $entityManager->flush();

                    $this->addFlash("message", "Message envoyé avec succès.");
            return $this->redirectToRoute("message_index");
        }

        return $this->render("messages/messageEnvoyer.html.twig", [
            'message' => $messages,
                        "formMessages" => $form->createView()
        ]);
    }

    /**
     * @Route("/messagesRecu", name="messagesRecu_index")
     */
    public function messageReçu(Request $request, Messages $messages): Response
    {
        $this->addFlash("success","Message reçu a été effectuée avec succés !");

        return $this->render('messages/messagesReçu.html.twig'[
]);
    }

    /**
     * @Route("/listeMessagesEnvoyer", name="listeMessagesEnvoyer_index")
     */
    public function listeMessagesEnvoyer(Request $request, Messages $messages): Response
    {
        return $this->render('messages/listeMessagesEnvoyer.html.twig');
    }

    /**
     * @Route("/listeMessagesRecu", name="listeMessagesRecu_index")
     */
    public function listeMessagesRecu(Request $request, Messages $messages): Response
    {
        return $this->render('messages/listeMessagesRecu.html.twig');
    }


    /**
     * @Route("/messagesLu/{id}", name="messagesLu_index")
     */
    public function messageLu(Request $request, Messages $messages): Response
    {
        $messages->setSiMessageLu(true);

        $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($messages);
            $entityManager->flush();
            $this->addFlash("success","Le message a été lu avec succés !");

        return $this->render('messages/messagesLu.html.twig', compact("message")[
]);
    }



}
