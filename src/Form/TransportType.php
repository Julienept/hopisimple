<?php

namespace App\Form;

use App\Entity\Transport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TransportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'label' => 'Type de transport',
                'choices' => [
                    'Votre véhicule personnel' => 'Votre véhicule personnel',
                    'Transport en commun' => 'Transport en commun',
                    'Véhicule d\'un ami' => 'Véhicule d\'un ami'
                ],
                'expanded' => true,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transport::class,
        ]);
    }
}
