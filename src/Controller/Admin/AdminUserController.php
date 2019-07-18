<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\AdminUserType;
use App\Form\AdminBookingType;
use App\Repository\UserRepository;
use App\Service\PaginationService;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminUserController extends AbstractController
{
     /**
     * @Route("/admin/users/{page<\d+>?1}", name="admin_users")
     */
    public function index(UserRepository $repo, $page, PaginationService $pagination)
    {
        $pagination->setEntityClass(User::class)
        ->setPage($page);

        return $this->render('admin/user/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/admin/users/{id}/edit", name="admin_users_edit", )
     * 
     * @return Response
     */
    public function edit(User $user, Request $request, ObjectManager $manager) {        
        
        $form = $this->createForm(AdminUserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();
            $this->addFlash(
                'success', 
                "L'utilisateur n°{$user->getId()} a bien été modifié." 
            );
            return $this->redirectToRoute('admin_users');
        }
        return $this->render('admin/user/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user
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
            "L'utilisateur a bien été supprimé."
        );
        return $this->redirectToRoute('admin_users');
    }
   
}
