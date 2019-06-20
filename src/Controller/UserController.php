<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileType;
use App\Entity\PasswordUpdate;
use App\Form\RegistrationType;
use App\Form\PasswordUpdateType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
     * @Route("/profil/messages", name="user_messages")
     */
    public function messages()
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }
}
