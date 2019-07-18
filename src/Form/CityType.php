<?php

namespace App\Form;

use App\Entity\City;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Votre ville'
            ])
            ->add('department', TextType::class, [
                'label' => 'Votre département' ])
            ->add('region', ChoiceType::class, [
                'label' => 'Votre région',
                'choices' => [
                    'Alsace' => 'Alsace',
                    'Aquitaine' => 'Aquitaine',
                    'Auvergne' => 'Auvergne',
                    'Bourgogne' => 'Bourgogne',
                    'Bretagne' => 'Bretagne',
                    'Centre' => 'Centre',
                    'Champagne-Ardenne' => 'Champagne-Ardenne',
                    'Corse' => 'Corse',
                    'Franche-Comté' => 'France-Comté',
                    'Ile-de-France' => 'Ile-de-France',
                    'Languedoc-Roussillon' => 'Languedoc-Roussillon',
                    'Limousin' => 'Limousin',
                    'Lorraine' => 'Lorraine',
                    'Midi-Pyrénées' => 'Midi-Pyrénées',                    
                    'Normandie' => 'Normandie',
                    'Nord-Pas-de-Calais' => 'Nord-Pas-de-Calais',
                    'Pays de la Loire' => 'Pays de la Loire',
                    'Picardie' => 'Picardie',
                    'Poitou-Charentes' => 'Poitou-Charentes',
                    'Provence-Alpes-Côte-d\'Azur' => 'Provence-Alpes-Côte-d\'Azur'
                ]
            ] )
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => City::class,
        ]);
    }
}
