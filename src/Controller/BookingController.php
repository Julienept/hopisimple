<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\Booking;
use App\Form\BookingType;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

class BookingController extends AbstractController
{
    /**
     * @Route("/annonces/{id}/booking", name="ad_booking")
     * @IsGranted("ROLE_USER")
     */
    public function booking(Ad $ad, Request $request, ObjectManager $manager)
    {
        $booking = new Booking;

        $user = $this->getUser();
                    $booking->setBooker($user)
                        ->setAd($ad)
                    ;

        

        $form = $this->createForm(BookingType::class, $booking);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $duration = $booking->getEndDate->diff($booking->getStartDate);

             $amount = $ad->getPrice() * $duration;

             $booking->setAmount($amount);

            $manager->persist($booking);

            $manager->flush();

            return $this->redirectToRoute('booking_success', [
                'id' => $booking->getId() 
            ]);
        }

        return $this->render('booking/booking.html.twig', [
            'ad' => $ad,
            'bookingForm' => $form->createView()
        ]);
    }
}
