<?php

namespace App\Form;

use App\Entity\Place;
use App\Entity\Train;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PlaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numPlace')
            ->add('occupation')
            ->add('trains',EntityType::class,['class'=> Train::class,
                'choice_label'=>'numTrain',
                'label'=>'Numero train'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Place::class,
        ]);
    }
}
