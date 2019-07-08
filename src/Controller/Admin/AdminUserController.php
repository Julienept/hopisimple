<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminUserController extends AbstractController
{
     /**
     * @Route("/admin/users", name="admin_users")
     */
    public function index(UserRepository $repo)
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $repo->findAll(),
        ]);
    }

    /**
     * 
     * @Route("/admin/users/{id}/delete", name="admin_users_delete")
     *
     * @return Response
     */
    public function delete(User $user, ObjectManager $manager) {

        $manager->remove($user);

        $manager->flush();

        $this->addFlash(
            'success',
            "L'utilisateur a bien été supprimé"
        );
        return $this->redirectToRoute('admin_users');
    }
   
}
