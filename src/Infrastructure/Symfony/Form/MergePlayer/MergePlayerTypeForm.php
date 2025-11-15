<?php

namespace Infrastructure\Symfony\Form\MergePlayer;

use Infrastructure\Entity\Doctrine\PlayerDoctrine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MergePlayerTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('player', EntityType::class, [
                'autocomplete' => true,
                'class' => PlayerDoctrine::class,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlayerDoctrine::class,
        ]);
    }
}

