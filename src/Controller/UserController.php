<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
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
