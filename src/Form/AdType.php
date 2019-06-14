<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextareaType::class)
            ->add('description', TextareaType::class)
            ->add('price', NumberType::class)
            ->add('date')
            ->add('privateTransport')
            ->add('publicTransport')
            ->add('atHome')
            ->add('atLaundryService')
            ->add('atFriendsPlace')
            ->add('gentleHouseholdProduct')
            ->add('hospitalProduct')
            ->add('earthProtection')
            ->add('dedicatedPlace')
            ->add('washer')
            ->add('handwashinhandwashing')
            ->add('tumbleDryer')
            ->add('airDrying')
            ->add('ironing')
            ->add('place')
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
