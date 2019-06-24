<?php

namespace App\Controller;

use DateTime;
use App\Entity\Ad;
use App\Form\AdType;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     * @Route("/annonces/ajouter", name="ads_new")
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function new(EntityManagerInterface $em, ObjectManager $manager, Request $request)
    {        
        $ad = new Ad();

        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $ad->setUser($user);           

            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre annonce a bien été publiée"
            );
            return $this->redirectToRoute('ads_show', [
                            'id' => $ad->getId() 
                        ]);


        }

        return $this->render('ad/new.html.twig', [
            'adForm' => $form->createView(),
        ]);
        
    
    }

     /**
     * @Route("/annonces/{id}", name="ads_show")
     * 
     * @return Response
     */
    public function showAd(AdRepository $AdRepository, $id)
    {
        // $contact = new Contact;
        
        // $form = $form = $this->createForm(ContactType::class, $contact);

        // $form->handleRequest($request);

        $ad = $AdRepository->findOneById($id);

        return $this->render('ad/show.html.twig', [
            'ad' => $ad,
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
