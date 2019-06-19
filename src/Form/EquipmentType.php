<?php

namespace App\Form;

use App\Entity\Equipment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class EquipmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('washing', ChoiceType::class, [
                'label' => 'Type de lavage',
                'choices' => [
                    'Machine à laver' => 'Machine à laver',
                    'Lavage à la main' => 'Lavage à la main'
                ],
                'expanded' => true,

            ] )
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
            ])        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Equipment::class,
        ]);
    }
}
