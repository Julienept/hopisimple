<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
  /**
     * @Route("/connexion", name="user_login")
     */
    public function login()
    {
        return $this->render('profile/index.html.twig');
    }

    /**
     * @Route("/inscription", name="user_signin")
     */
    public function signin()
    {
        return $this->render('profile/index.html.twig');
    }

    /**
     * @Route("/deconnexion", name="user_logout")
     */
    public function logout()
    {
        return $this->render('profile/index.html.twig');
    }
    /**
     * @Route("/profil/{id}", name="user_profile")
     */
    public function account()
    {
        return $this->render('profile/index.html.twig');
    }

    /**
     * @Route("/profil/{id}/modifier", name="user_update")
     */
    public function update()
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    /**
     * @Route("/profil/{id}/supprimer", name="user_delete")
     */
    public function delete()
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
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
