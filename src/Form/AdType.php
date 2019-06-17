<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de l\'annonce'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de l\'annonce'
            ])
            ->add('price', NumberType::class, [
                'label' => 'Votre tarif'
            ]) 
            ->add('place', TextareaType::class, [
                'label' => 'Ville où se déroulera la prestation'
            ])
            ->add('privateTransport', RadioType::class, [
                'label' => 'Votre véhicule personnel'
            ])
            ->add('publicTransport', RadioType::class, [
                'label' => 'En transport en commun'
            ])
            ->add('atHome', RadioType::class, [
                'label' => 'A votre domicile',
                'required' => 'true', 

                ])
            ->add('atLaundryService', RadioType::class)
            ->add('atFriendsPlace', RadioType::class)
            ->add('gentleHouseholdProduct')
            ->add('hospitalProduct')
            ->add('earthProtection')
            ->add('dedicatedPlace')
            ->add('washer')
            ->add('handwashinhandwashing')
            ->add('tumbleDryer')
            ->add('airDrying')
            ->add('ironing')
            ->add('tags')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
