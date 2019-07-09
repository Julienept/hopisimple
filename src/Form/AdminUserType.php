<?php

namespace App\Form;

use App\Entity\User;
use App\Form\PlaceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdminUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title', ChoiceType::class, [
            'label' => 'Titre',
            'choices' => [
            'Madame' => 'Madame',
            'Monsieur' => 'Monsieur'
        ],
            'expanded' => true,
        ])
        ->add('firstname', TextType::class,  [
            'label' => 'Prénom',
        ])
        ->add('lastname', TextType::class,  [
            'label' => 'Nom',
        ])
        ->add('picture', UrlType::class, [
            'label' => 'Photo de profil',
            'required' => false
        ])
        ->add('biography', TextareaType::class,  [
            'label' => 'Biographie',
            'required' => false
        ])
        ->add('place', PlaceType::class, [
            'label' => 'Informations personnelles'
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
