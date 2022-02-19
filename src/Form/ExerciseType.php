<?php

namespace App\Form;

use App\Entity\Exercise;
use App\Entity\RecordedExercise;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExerciseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('recorded_exercise', EntityType::class, [
                'class' => RecordedExercise::class,
                'placeholder' => 'Choose an option',
                'choice_label' => 'name',
                'mapped' => false,
                'required' => false
            ])
            ->add('name')
            ->add('series', CollectionType::class, [
                'entry_type' => SeriesType::class,
                'allow_add' => true,
                'by_reference' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercise::class,
        ]);
    }
}
