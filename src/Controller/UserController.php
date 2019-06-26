<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\User;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Form\ProfileType;
use App\Entity\PasswordUpdate;
use App\Form\RegistrationType;
use App\Form\PasswordUpdateType;
use App\Repository\AdRepository;
use App\Repository\UserRepository;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
  
    /**
     * @Route("/monprofil", name="your_profile")
     */
    public function account()
    {
        return $this->render('user/profile.html.twig', [
            'user' => $this->getUser()
        ]);
    }

    /**
     * @Route("/profil/modifier", name="user_update")
     * @return Response
     */
    public function accountUpdate(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(ProfileType::class, $user);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {              
            
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Vos modifications ont bien été prises en compte"
            );
            return $this->redirectToRoute('user_login');

        }
        return $this->render('user/profile-update.html.twig', [
                    'user' => $this->getUser(),
                    'profileForm' => $form->createView()
                ]);
            
    }
        
    
    /**
     * @Route("/utilisateurs/{id}", name="user_profile")
     */
    public function userAccount(User $user)
    {
        return $this->render('user/user-profile.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/utilisateurs/{id}/contacter", name="user_contact")
     * @IsGranted("ROLE_USER")
     */
    public function userContact(EntityManagerInterface $em, ObjectManager $manager, Request $request, User $userContact, \Swift_Mailer $mailer)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {              
            $user = $this->getUser();
            $contact->setAuthor($user); 

            $manager->persist($contact);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre message a bien été envoyé"
            );

            $message = (new \Swift_Message('hopisimple : nouveau message'))
        ->setFrom('hopisimple@gmail.com')
        ->setTo('lfbjulie@gmail.com')
        ->setBody(
            $this->renderView(
                // templates/emails/registration.html.twig
                'emails/contact.html.twig',
                ['name' => $userContact->getFirstname()]
            ),
            'text/html'
        )

        // ->addPart(
        //     $this->renderView(
        //         'emails/contact.txt.twig',
        //         ['name' => $userContact->getFirstname()]
        //     ),
        //     'text/plain'
        // )
        ;
           $mailer->send($message);
            return $this->redirectToRoute('homepage');

        }
        return $this->render('user/user-contact.html.twig', [
            'contactForm' => $form->createView(),
            'user' => $userContact
        ]);
    }

    
     /**
     * @Route("/messages", name="user_messages")
     */
    public function messages(ContactRepository $contact)
    {
        return $this->render('user/messages.html.twig', [
            'user' => $this->getUser(),
            'contact' => $contact
        ]);
    }
}
