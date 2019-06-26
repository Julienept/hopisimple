<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminUserController extends AbstractController
{
     /**
     * @Route("/admin/login", name="admin_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();

        $username = $utils->getLastUsername();

        return $this->render('admin/user/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }
    /** 
     * @Route("/admin/logout", name="admin_logout")
     *
     * @return void
     */
    public function logout() {
        // ...
    }
}
