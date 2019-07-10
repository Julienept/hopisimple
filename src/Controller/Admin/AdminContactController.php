<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminContactController extends AbstractController
{
    /**
     * @Route("/admin/messages", name="admin_contact")
     */
    public function index(ContactRepository $repo)
    {
        return $this->render('admin/contact/index.html.twig', [
            'contacts' => $repo->findAll(),
        ]);
    }

     /**
     * 
     * @Route("/admin/messages/{id}/delete", name="admin_contact_delete")
     *
     * @return Response
     */
    public function delete(Contact $contact, ObjectManager $manager) {

        $manager->remove($contact);

        $manager->flush();

        $this->addFlash(
            'success',
            "Le message n°{$contact->getId()} a bien été a bien été supprimé."
        );
        return $this->redirectToRoute('admin_contact');
    }
}
