<?php

namespace App\Form;

use App\Entity\ProductsPromotions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsPromotionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('start_date', options:[
                'label' => 'Date de début'
            ])
            ->add('end_date', options:[
                'label' => 'Date de fin'
            ])
            ->add('discount', options:[
                'label' => 'Valeur de la promotion'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductsPromotions::class,
        ]);
    }
}
