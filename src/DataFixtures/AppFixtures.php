<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Ad;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Place;
use Doctrine\Migrations\Version\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        $places = [];
        $genres = ['Monsieur', 'Madame'];
        // Gestion des adresses

        for($p=1; $p<= 50; $p++)
        {
    
        $place = new Place;

        $place->setStreetNumber($faker->randomFloat)
                ->setStreetName($faker->streetName)
                ->setPostalCode($faker->buildingNumber)
                ->setCity($faker->city)
                ->setCountry('France')
        ;
        $manager->persist($place);

        $places[] = $place;

        }

        $users = [];

        for($u=1; $u<= 50; $u++)
        {
        $genre = $genres[mt_rand(0, 1)];
        

        $place = $places[mt_rand(0, count($places) - 1)];
        
        $user = new User;

        $password = $this->encoder->encodePassword($user, 'password');

        $user->setTitle($genre)
            ->setFirstname($faker->firstname)
            ->setLastname($faker->firstname)
            ->setEmail($faker->email)
            ->setPassword($password)
            ->setBiography($faker->paragraph(1))
            ->setInscriptionDate(new \DateTime())
            ->setPlace($place)
            ->setPicture($faker->imageUrl($width = 100, $height = 30))
        ;
        $manager->persist($user);
        $users = $user;
        }

        for($i=1; $i<= 100; $i++)
        {
        $ad = new Ad;

            $ad->setTitle($faker->sentence(1))
                ->setDescription($faker->paragraph(2))
                ->setPrice(mt_rand(6,19))
                ->setCreatedAt(new \DateTime())
                ->setCity($faker->city)
                ->setUser($user)
                ->setAtFriendsPlace(mt_rand(0,1))
                ->setAtHome(mt_rand(0,1))
                ->setAtLaundryService(mt_rand(0,1))
                ->setAirDrying(mt_rand(0,1))
                ->setHandwashinhandwashing(mt_rand(0,1))
                ->setIroning(mt_rand(0,1))
                ->setTumbleDryer(mt_rand(0,1))
                ->setWasher(mt_rand(0,1))
                ->setPrivateTransport(mt_rand(0,1))
                ->setPublicTransport(mt_rand(0,1));

            $manager->persist($ad);
        }

        $manager->flush();
    }
}
