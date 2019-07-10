<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Form\AdminRatingType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact_us")
     */
    public function contact(EntityManagerInterface $em, Request $request, ObjectManager $manager)
    {
        $contact = New Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
        
            $manager->persist($contact);
            $manager->flush();
            $this->addFlash(
                'success', 
                "Votre message n°{$contact->getId()} a bien été envoyé." 
            );
            return $this->redirectToRoute('contact_show', [
                'id' => $contact->getId()
            ]);
        }
        return $this->render('contact/new.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/contact/{id}", name="contact_show")
     * 
     * @return Response
     */
    public function showContact(ContactRepository $repo, $id)
    {
        $contact = $repo->findOneById($id);

        return $this->render('contact/show.html.twig', [
            'contact' => $contact,
        ]);
    }
}
