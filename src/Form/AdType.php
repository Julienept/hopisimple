<?php

namespace App\Form;

use App\Entity\Ad;
use App\Entity\Tag;
use App\Form\TagType;
use App\Form\BonusType;
use App\Form\EquipmentType;
use App\Form\TransportType;
use App\Form\EstablishmentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Proxies\__CG__\App\Entity\City;

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
            ->add('city', CityType::class, [
                'label' => 'Information autour du lieu de prestation'
            ])
            ->add('establishment', ChoiceType::class, [
                'label' => 'Lieu de la prestation',
                'choices' => [
                    'A votre domicile' => 'A votre domicile',
                    'Dans un lavomatique' => 'Transport en Dans un lavomatique',
                    'Chez un ami' => 'Chez un ami'
                ],
                'expanded' => true,
                ])
            ->add('washing', ChoiceType::class, [
                'label' => 'Type de lavage',
                'choices' => [
                    'Machine à laver' => 'Machine à laver',
                    'Lavage à la main' => 'Lavage à la main'
                ],
                'expanded' => true,
            ])
            ->add('drying', ChoiceType::class, [
                'label' => 'Type de séchage',
                'choices' => [
                    'Sèche-linge' => 'Sèche-linge',
                    'Sèchage à l\'air libre' => 'Sèchage à l\'air libre'
                ],
                'expanded' => true,
                ])
                ->add('ironing', CheckboxType::class, [
                    'label' => 'Repassage'
                ])
            ->add('transport', ChoiceType::class, [
                'label' => 'Type de transport',
                'choices' => [
                    'Votre véhicule personnel' => 'Votre véhicule personnel',
                    'Transport en commun' => 'Transport en commun',
                    'Véhicule d\'un ami' => 'Véhicule d\'un ami'
                ],
                'expanded' => true,
                ])
            ->add('productType', ChoiceType::class, [
                    'label' => 'Type de produits',
                    'choices' => [
                        'Produits ménagers doux' => 'Produits ménagers doux',
                        'Produits hospitaliers' => 'Produits hospitaliers'
                    ],
                    'expanded' => true,
                ])
            ->add('earthProtection', CheckboxType::class, [
                    'label' => 'Respect de l\'environnement',
                    ])
            ->add('dedicatedSpace', CheckboxType::class, [
                    'label' => 'Espace dédié',
                    ])
            ->add('tags', EntityType::class,[ 
                'class' => Tag::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
            ])
          ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
