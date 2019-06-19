<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Ad;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Place;
use App\Entity\Transport;
use Doctrine\Migrations\Version\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Establishment;
use App\Entity\Equipment;

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

        // Gestion des utilisateurs
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


        // Gestion des annonces
        for($i=1; $i<= 100; $i++)
        {
        $ad = new Ad;

        $washing = ['washer', 'handWashing'];

        $washRand = $washing[mt_rand(0,1)];

        $drying =  ['airDrying', 'tumbleDryer'];

        $dryRand = $drying[mt_rand(0,1)];

        $ironing = [true, false];

        $irRand = $ironing[mt_rand(0,1)];

        // ---
        $est = ['atHome', 'atFriendsPlace', 'atLaundyShop'];
        
        $estRand = $est[mt_rand(0,2)];

        $adEst = new Establishment;

        $adEst->setPlace($estRand);

        $eq = new Equipment;

        $eq->setWashing($washRand)
            ->setDrying($dryRand)
            ->setIroning($irRand)
            ;

        // ---
        $transport = ['private', 'transport'];

        $transRand = $transport[mt_rand(0,1)];

        $adTransport = new Transport;

        $adTransport->setType($transRand);


            $ad->setTitle($faker->sentence(1))
                ->setDescription($faker->paragraph(2))
                ->setPrice(mt_rand(6,19))
                ->setCreatedAt(new \DateTime())
                ->setCity($faker->city)
                ->setUser($user)
                ->setEstablishment($adEst)
                ->setTransport($adTransport)
                ->setEquipment($eq);

            $manager->persist($ad);
        }


        // Gestion des tags

        for ($t=1; $t<=10; $t++)
        {
            $tags = new Tag;

            $name = $faker->word();

            $tags->setName($name)
                ->addAd($ad);

            $manager->persist($tags);

        }
        
        $manager->flush();
    }
}
