<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\Booking;
use App\Form\BookingType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingController extends AbstractController
{
    /**
     * @Route("/ads/{id}/booking", name="ad_booking")
     * @IsGranted("ROLE_USER")
     * 
     * @return Response
     */
    public function booking(Ad $ad, Request $request, ObjectManager $manager)
    {
        $booking = new Booking;        

        $form = $this->createForm(BookingType::class, $booking);

        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user = $this->getUser();
                $booking->setBooker($user) 
                        ->setAd($ad)
                        ;

            if(!$booking->isAvailableDate())
            {
                $this->addFlash(
                    'warning',
                    'Attention, les dates que vous avez choisies ne sont pas disponibles, elles ont déjà été réservées.'
                );
            }
            else
            {
            $manager->persist($booking);

            $manager->flush();

            $this->addFlash(
                'success',
                "Votre réservation a bien été effectuée !"
            );

            return $this->redirectToRoute('booking_show', [
                'id' => $booking->getId(),
                'withAlert' => true
            ]);
            }
        }

        return $this->render('booking/booking.html.twig', [
            'ad' => $ad,
            'bookingForm' => $form->createView()
        ]);
    
    }

    /**
     * @Route("/booking/{id}", name="booking_show")
     * @return Response
     */
    public function show(Booking $booking)
    {

        return $this->render('booking/show.html.twig', [
            'booking' => $booking
        ]);
    }
}
