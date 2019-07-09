<?php

namespace App\Controller\Admin;

use App\Entity\Rating;
use App\Repository\RatingRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminRatingController extends AbstractController
{
    /**
     * @Route("/admin/ratings", name="admin_rating")
     */
    public function show(RatingRepository $repo)
    {
        return $this->render('/admin/rating/index.html.twig', [
            'ratings' => $repo->findAll(),
        ]);
    }

    /**
     * @Route("/admin/ratings/{id}/edit", name="admin_rating_edit")
     */
    public function edit(Rating $rating)
    {
        return $this->render('/admin/rating/index.html.twig');
    }

    /**
     * @Route("/admin/ratings/{id}/delete", name="admin_rating_delete")
     */
    public function delete(Rating $rating)
    {
        return $this->render('/admin/rating/index.html.twig');
    }
}
