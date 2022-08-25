<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Place;
use App\Entity\Train;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numReservation')
            ->add('nomVoyageur')
            ->add('dateReservation')
            ->add('trains',EntityType::class,['class'=> Train::class,
                'choice_label'=>'numTrain',
                'label'=>'Numero train'])
            ->add('places',EntityType::class,['class'=> Place::class,
                'choice_label'=>'numPlace',
                'label'=>'Numero place'])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
