<?php

namespace App\Form;

use App\Entity\Place;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PlaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('streetNumber', NumberType::class, [
                'label' => 'Numéro de rue'
            ])
            ->add('streetName', TextareaType::class, [
                'label' => 'Votre rue'
            ])
            ->add('addressSupplement', TextareaType::class, [
                'label' => 'Complément d\'adresse'
            ])
            ->add('postalCode', NumberType::class, [
                'label' => 'Votre code postal'
            ])
            ->add('city', TextType::class, [
                'label' => 'Votre commune'
            ])
            ->add('country', TextType::class, [
                'label' => 'Votre pays'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Place::class,
        ]);
    }
}
