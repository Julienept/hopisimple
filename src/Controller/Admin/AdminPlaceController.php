<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminPlaceController extends AbstractController
{
    /**
     * @Route("/admin/place", name="admin_place")
     */
    public function index()
    {
        return $this->render('admin_place/index.html.twig', [
            'controller_name' => 'AdminPlaceController',
        ]);
    }
}
