<?php

namespace App\Form;

use App\Entity\User;
use App\Form\PlaceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProfileType extends AbstractType
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
            'label' => 'Votre prénom',
        ])
        ->add('lastname', TextType::class,  [
            'label' => 'Votre nom',
        ])
        ->add('email', EmailType::class,  [
            'label' => 'Votre adresse mail',
        ])
        ->add('picture', UrlType::class, [
            'label' => 'Votre photo de profil',
            'required' => false
        ])
        ->add('biography', TextareaType::class,  [
            'label' => 'Votre biographie',
            'required' => false
        ])
        ->add('place', PlaceType::class, [
            'label' => 'Vos informations personnelles'
        ])
    ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
