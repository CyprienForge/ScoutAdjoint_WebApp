<?php

namespace Infrastructure\Symfony\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchPlayerTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name', TextType::class, [
                'required' => false,
                'label' => 'Prénom',
            ])
            ->add('last_name',  TextType::class, [
                'required' => false,
                'label' => 'Nom',
            ])
            ->add('start_birth_date', DateType::class, [
                'required' => false,
                'label' => 'Date de naissance min.',
            ])
            ->add('end_birth_date', DateType::class, [
                'required' => false,
                'label' => 'Date de naissance max.',
            ])
            ->add('team', TextType::class, [
                'required' => false,
            ])
            ->add('positions', ChoiceType::class, [
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices' => $options['positions'],
                'choice_label' => fn($position) => $position->getLibelle(),
                'choice_value' => fn($position) => $position ? $position->getId() : '',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'method' => 'GET',
            'positions' => [],
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }

}
