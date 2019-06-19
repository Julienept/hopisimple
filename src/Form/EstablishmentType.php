<?php

namespace App\Form;

use App\Entity\Establishment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EstablishmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('place', ChoiceType::class, [
                'label' => 'Lieu de la prestation',
                'choices' => [
                    'A votre domicile' => 'A votre domicile',
                    'Dans un lavomatique' => 'Transport en Dans un lavomatique',
                    'Chez un ami' => 'Chez un ami'
                ],
                'expanded' => true,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Establishment::class,
        ]);
    }
}
