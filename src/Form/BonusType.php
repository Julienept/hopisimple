<?php

namespace App\Form;

use App\Entity\Bonus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class BonusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bonus::class,
        ]);
    }
}
