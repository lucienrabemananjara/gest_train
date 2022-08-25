<?php

namespace App\Form;

use App\Entity\Train;
use App\Entity\Itineraire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
// use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class TrainType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numTrain')
            ->add('designTrain')
            ->add('nbrPlace')
            ->add('itineraires',EntityType::class,['class'=> Itineraire::class,
                'choice_label'=>'numItineraire',
                'label'=>'Numero itineraire'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Train::class,
        ]);
    }
}
