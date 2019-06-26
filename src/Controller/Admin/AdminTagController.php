<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminTagController extends AbstractController
{
    /**
     * @Route("/admin/tag", name="admin_tag")
     */
    public function index()
    {
        return $this->render('admin_tag/index.html.twig', [
            'controller_name' => 'AdminTagController',
        ]);
    }
}
