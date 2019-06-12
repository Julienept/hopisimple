<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Place;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $place = new Place;
        $user = new User;
        
        $place->setStreetNumber(1)
                ->setStreetName('rue des ergots')
                ->setPostalCode(77000)
                ->setCity('Melun')
                ->setCountry('France')
        ;
        $manager->persist($place);


       $user->setTitle('Madame')
            ->setFirstname('Mirabelle')
            ->setLastname('Gaia')
            ->setEmail('mirabelle@gaia.fr')
            ->setPassword('test')
            ->setInscriptionDate(new \DateTime())
            ->setPlace($place)
       ;
       $manager->persist($user);

        for($i= 1; $i <= 20; $i++){
            $ad = new Ad;

            $ad->setTitle('Titre de l\'annonce')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fermentum semper lobortis. Fusce vel mollis quam, id vulputate sem. Sed eu nulla vel felis lobortis condimentum. In viverra pretium orci, vitae dapibus augue iaculis ut. Vivamus vel orci nec nisi porttitor mattis. Aenean ullamcorper sollicitudin erat non placerat. Fusce sed eros sed tortor malesuada bibendum in tristique justo. Mauris rutrum vulputate ante quis facilisis. Praesent tristique porta elit non viverra. Cras pellentesque viverra arcu sed imperdiet. Nunc in euismod eros, quis feugiat eros.')
            ->setPrice(13)
            ->setCreatedAt(new \DateTime())
            ->setPlace($place)
            ->setUser($user)
            ->setAtFriendsPlace(0)
            ->setAtHome(1)
            ->setAtLaundryService(0)
            ->setAirDrying(1)
                ->setHandwashinhandwashing(0)
                ->setIroning(1)
                ->setTumbleDryer(1)
                ->setWasher(1)
                ->setPrivateTransport(1)
                ->setPublicTransport(0);

            $manager->persist($ad);
    }


        $manager->flush();
    }
}
