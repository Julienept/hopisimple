<?php

namespace App\Controller\Admin;

use App\Entity\Booking;
use App\Form\AdminBookingType;
use App\Service\PaginationService;
use App\Repository\BookingRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class AdminBookingController extends AbstractController
{
    /**
     * @Route("/admin/bookings/{page<\d+>?1}", name="admin_bookings")
     */
    public function index(BookingRepository $repo, $page, PaginationService $pagination)
    {        
        $pagination->SetEntityClass(Booking::class)
        ->setPage($page)
        ;

        return $this->render('admin/booking/index.html.twig', [
            'pagination' => $pagination
        ]); 
    }

    /**
     * @Route("/admin/bookings/{id}/edit", name="admin_booking_edit", )
     * 
     * @return Response
     */
    public function edit(Booking $booking, Request $request, ObjectManager $manager) {        
        
        $form = $this->createForm(AdminBookingType::class, $booking);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $booking->setAmount(0);
            $manager->persist($booking);
            $manager->flush();
            $this->addFlash(
                'success', 
                "La réservation n°{$booking->getId()} a bien été modifiée" 
            );
            return $this->redirectToRoute('admin_bookings');
        }
        return $this->render('admin/booking/edit.html.twig', [
            'form' => $form->createView(),
            'booking' => $booking
        ]);
    }
    
    /**
     * 
     * @Route("/admin/bookings/{id}/delete", name="admin_booking_delete")
     *
     * @return Response
     */
    public function delete(Booking $booking, ObjectManager $manager) {

        $manager->remove($booking);

        $manager->flush();

        $this->addFlash(
            'success',
            "La réservation n°{$booking->getId()} a bien été supprimée"
        );
        return $this->redirectToRoute('admin_bookings');
    }
}
