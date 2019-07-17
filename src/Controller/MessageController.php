<?php

namespace App\Controller;


use App\Entity\Ad;
use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\User;


class MessageController extends AbstractController
{

    /**
     * @Route("/ads/{id}/message", name="message_provider")
     * @IsGranted("ROLE_USER")
     * 
     * @return Response
     */
    public function message(Ad $ad, Request $request, ObjectManager $manager, $id)
    {
        $message = New Message();

        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $receiver = $ad->getUser($id);
            $user = $this->getUser();
            $message->setSender($user) 
                        ->setAd($ad)
                    ->setReceiver($receiver)
                    ;

        
            $manager->persist($message);
            
            $manager->flush();

            $this->addFlash(
                'success', 
                "Votre message a bien été envoyé." 
            );
            return $this->redirectToRoute('conversation_show', [
                'id' => $message->getId()
            ]);
        }
        return $this->render('mailbox/new.html.twig', [
            'ad' => $ad,
            'form' => $form->createView()
            
        ]);
    }

    /**
     * @Route("/{id}/mailbox", name="user_mailbox")
     * 
     * @return Response
     */
    public function mailbox(MessageRepository $repo)
    {
        $messages = $repo->findAll();

        return $this->render('mailbox/mailbox.html.twig', [
            'messages' => $messages,
        ]);
    }

    /**
     * @Route("/mailbox/{id}/conversation", name="conversation_show")
     * 
     * @param Message $message
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function conversation(Message $message, Request $request, ObjectManager $manager, Ad $ad, $id)
    {
        $newMessage = New Message();

        $form = $this->createForm(MessageType::class, $newMessage);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $receiver = $user->getFirstname($id);

            dd($receiver);
            $message->setSender($this->getUser()) 
                    ->setReceiver($receiver)
                    ;

        
            $manager->persist($newMessage);
            
            $manager->flush();

            $this->addFlash(
                'success', 
                "Votre message a bien été envoyé." 
            );
            return $this->redirectToRoute('conversation_show', [
                'id' => $message->getId()
            ]);
        }


        return $this->render('mailbox/show.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
            'ad' => $ad

        ]);
    }

}
