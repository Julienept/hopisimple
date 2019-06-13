<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AdRepository;

class AdController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        return $this->render('home/home.html.twig', [
            'controller_name' => 'AdController',
        ]);
    }
    
    /**
     * @Route("/annonces", name="ads_list")
     */
    public function allAds(AdRepository $AdRepository)
    {
        $ads = $AdRepository->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads,
        ]);

    }

     /**
     * @Route("/annonces/{id}", name="ads_show")
     * 
     * @return Response
     */
    public function showAd(AdRepository $AdRepository, $id)
    {
        $ad = $AdRepository->findOneById($id);

        return $this->render('ad/show.html.twig', [
            'ad' => $ad,
        ]);
    }

    /**
     * @Route("/annonces/ajouter", name="ads_new")
     */
    public function new()
    {
        return $this->render('ad/index.html.twig', [
            'controller_name' => 'AdController',
        ]);
    }

    /**
     * @Route("/annonces/{id}/modifier", name="ads_update")
     */
    public function update()
    {
        return $this->render('ad/index.html.twig', [
            'controller_name' => 'AdController',
        ]);
    }

    /**
     * @Route("/annonces/{id}/supprimer", name="ads_delete")
     */
    public function delete()
    {
        return $this->render('ad/index.html.twig', [
            'controller_name' => 'AdController',
        ]);
    }

    /**
     * @Route("/annonces/{id}/prestataire", name="ads_profile")
     */
    public function profile()
    {
        return $this->render('ad/index.html.twig', [
            'controller_name' => 'AdController',
        ]);
    }

    /**
     * @Route("/annonces/{id}/prestataire/notation", name="ads_profile_rating")
     */
    public function profileRating()
    {
        return $this->render('ad/index.html.twig', [
            'controller_name' => 'AdController',
        ]);
    }

    /**
     * @Route("/annonces/{id}/prestataire/contacter", name="ads_profile_contact")
     */
    public function profileContact()
    {
        return $this->render('ad/index.html.twig', [
            'controller_name' => 'AdController',
        ]);
    }
  
    /**
     * @Route("/annonces/{id}/signaler", name="ads_report")
     */
    public function report()
    {
        return $this->render('ad/index.html.twig', [
            'controller_name' => 'AdController',
        ]);
    }
}
