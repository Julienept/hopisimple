<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="user_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();

        $username = $utils->getLastUsername();

        return $this->render('user/login.html.twig', [
            'errorDetected' => $error !== null,
            'username' => $username
        ]);
    }

    /**
     * @Route("/inscription", name="user_signin")
     * @return Response
     */
    public function signin(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User;

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {              
            $password = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre compte a bien été crééé"
            );
            return $this->redirectToRoute('user_login');

        }

        return $this->render('user/registration.html.twig', [
            'userForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/deconnexion", name="user_logout")
     * @return void 
     */
    public function logout()
    {
        

        return $this->render('user/index.html.twig');
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
}
