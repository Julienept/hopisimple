<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RatingRepository;

class RatingController extends AbstractController
{
    /**
     * @Route("/ratings", name="rating")
     */
    public function show(RatingRepository $repo)
    {
        return $this->render('/rating/index.html.twig', [
            'rating' => $repo->findAll(),
        ]);
    }
}
