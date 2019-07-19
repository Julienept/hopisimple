<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\PasswordUpdate;
use App\Form\RegistrationType;
use App\Form\PasswordUpdateType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="user_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();

        $username = $utils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'errorDetected' => $error !== null,
            'username' => $username
        ]);
    }

    /**
     * @Route("/signin", name="user_signin")
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

        return $this->render('security/registration.html.twig', [
            'userForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/logout", name="user_logout")
     * @return void 
     */
    public function logout()
    {
        return $this->render('security/index.html.twig');
    }

     /**
     * @Route("/account/password-update", name="user_password_update")
     * @return Response
     */
    public function passwordUpdate(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $passwordUpdate = new PasswordUpdate;

        $user = $this->getUser();


        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {  
            if(!password_verify($passwordUpdate->getOldPassword(), $user->getPassword()))
            {

            }
            else 
            {
              $newPassword = $passwordUpdate->getNewPassword();
            $hash = $encoder->encodePassword($user, $newPassword);

            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre mot de passe a bien été modifié"
            );
            return $this->redirectToRoute('your_profile');  
            }
            

        }
        return $this->render('security/password-update.html.twig', [
                    'passForm' => $form->createView()
                ]);
            
    }

}
