<?php

namespace App\Controller\Admin;

use App\Entity\Ad;
use App\Form\AdType;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAdController extends AbstractController
{
    /**
     * @Route("/admin/ads", name="admin_ads")
     */
    public function index(AdRepository $repo)
    {
        return $this->render('admin/ad/index.html.twig', [
            'ads' => $repo->findAll(),
        ]);
    }


    /**
     * Permet d'afficher le formulaire d'édition
     * 
     * @Route("/admin/ads/{id}/edit", name="admin_ads_edit")
     *
     * @param Ad
     * @return Response
     */
    public function edit(Ad $ad, Request $request, ObjectManager $manager) 
    {
        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($ad);
            $manager->flush();
            $this->addFlash(
                'success',
                "L'annonce <strong>{$ad->getTitle()}</strong> a bien été modifiée."
            );
        }
        return $this->render('admin/ad/edit.html.twig', [
            'ad' => $ad,
            'form' => $form->createView()
        ]);
    }

    /**     
     * @Route("/admin/ads/{id}/delete", name="admin_ads_delete")
     * 
     * @param Ad 
     * @param ObjectManager 
     * @return Response
     */
    public function delete(Ad $ad, ObjectManager $manager) 
    {
        if(count($ad->getBookings()) > 0) {
            $this->addFlash(
                'warning',
                "Vous ne pouvez pas supprimer l'annonce <strong>{$ad->getTitle()}</strong> car il y a des réservations en cours."
            );
        } else {
            $manager->remove($ad);
            $manager->flush();
    
            $this->addFlash(
                'success',
                "L'annonce <strong>{$ad->getTitle()}</strong> a bien été supprimée."
            );
        }
        return $this->redirectToRoute('admin_ads');
    }

}
