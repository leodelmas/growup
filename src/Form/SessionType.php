<?php

namespace App\Form;

use App\Entity\Session;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('start', DateTimeType::class, [
                'widget' => 'single_text',
                'required' => false,
                'model_timezone' => 'UTC',
                'view_timezone' => date_default_timezone_get()
            ])
            ->add('end', DateTimeType::class, [
                'widget' => 'single_text',
                'required' => false,
                'model_timezone' => 'UTC',
                'view_timezone' => date_default_timezone_get()
            ])
            ->add('mood', RangeType::class, [
                'attr' => [
                    'min' => 1,
                    'max' => 5
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
