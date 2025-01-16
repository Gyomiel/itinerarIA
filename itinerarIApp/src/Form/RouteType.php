<?php

namespace App\Form;

use App\Entity\Route;
use App\Entity\Truck;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RouteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('route_date', null, [
                'widget' => 'single_text',
            ])
            ->add('estimated_duration', null, [
                'widget' => 'single_text',
            ])
            ->add('total_distance')
            ->add('truck', EntityType::class, [
                'class' => Truck::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Route::class,
        ]);
    }
}
