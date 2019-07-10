<?php

namespace App\Controller\Admin;

use App\Entity\Rating;
use App\Form\AdminRatingType;
use App\Repository\RatingRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminRatingController extends AbstractController
{
    /**
     * @Route("/admin/ratings", name="admin_rating")
     */
    public function show(RatingRepository $repo)
    {
        return $this->render('admin/rating/index.html.twig', [
            'ratings' => $repo->findAll(),
        ]);
    }

    /**
     * @Route("/admin/ratings/{id}/edit", name="admin_rating_edit")
     */
    public function edit(Rating $rating,  Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(AdminRatingType::class, $rating);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($rating);
            $manager->flush();
            $this->addFlash(
                'success', 
                "La notation n°{$rating->getId()} a bien été modifiée" 
            );
            return $this->redirectToRoute('admin_rating');
        }
        return $this->render('admin/rating/edit.html.twig', [
            'form' => $form->createView(),
            'rating' => $rating
        ]);
    }

    /**
     * @Route("/admin/ratings/{id}/delete", name="admin_rating_delete")
     */
    public function delete(Rating $rating, ObjectManager $manager)
    {
        $manager->remove($rating);

        $manager->flush();

        $this->addFlash(
            'success',
            "La notation a bien été supprimée."
        );
        return $this->redirectToRoute('admin_rating');    
    }
}
