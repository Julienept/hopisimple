<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegistrationType extends AbstractType
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
                'required' => true
            ])
            ->add('firstname', TextType::class,  [
                'label' => 'Votre prénom',
                'required' => true
            ])
            ->add('lastname', TextType::class,  [
                'label' => 'Votre nom',
                'required' => true
            ])
            ->add('email', EmailType::class,  [
                'label' => 'Votre adresse mail',
                'required' => true
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Votre mot de passe',
                'required' => true
            ])
            ->add('picture', UrlType::class, [
                'label' => 'Votre photo de profil',
                'required' => false
            ])
            ->add('biography', TextareaType::class,  [
                'label' => 'Votre biographie',
                'required' => false
            ])
            ->add('place')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
