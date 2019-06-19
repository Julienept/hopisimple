<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\TagType;
use App\Form\BonusType;
use App\Form\EquipmentType;
use App\Form\TransportType;
use App\Form\EstablishmentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

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
            ->add('city', TextType::class, [
                'label' => 'Ville où se déroulera la prestation'
            ])
            ->add('establishment', EstablishmentType::class, [
                'label' => 'Lieu de votre prestation'
            ])
            ->add('equipment', EquipmentType::class, [
                'label' => 'Votre équipement'
            ])
            ->add('transport', TransportType::class, [
                'label' => 'Votre moyen de transport'
            ])
            ->add('bonus', BonusType::class, [
                'label' => 'Démarquez-vous'
            ])
            ->add('tags', CollectionType::class, [ 
            'entry_type' => TagType::class,
            'allow_add'    => true,

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
