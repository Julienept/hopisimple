<?php

namespace App\Controller;

use App\Entity\Ad;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\BookingType;
use App\Entity\Booking;

class BookingController extends AbstractController
{
    /**
     * @Route("/annonces/{id}/booking", name="ad_booking")
     */
    public function booking(Ad $ad)
    {
        $booking = new Booking;

        $form = $this->createForm(BookingType::class, $booking);

        return $this->render('booking/booking.html.twig', [
            'ad' => $ad,
            'bookingForm' => $form->createView()
        ]);
    }
}
