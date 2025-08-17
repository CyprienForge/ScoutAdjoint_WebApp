<?php

namespace Infrastructure\Symfony\Form;

use Domain\Dto\CreatePlayer\CreatePlayerDTO;
use Domain\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreatePlayerTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('birthDate', DateType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text',
            ])
            ->add('team', ChoiceType::class, [
                'choices' => $options['teams'],
                'choice_label' => fn($team) => $team->getName(),
                'choice_value' => fn($team) => $team ? $team->getId() : '',
                'label' => 'Équipe',
            ])
            ->add('positions', ChoiceType::class, [
                'choices' => $options['positions'],
                'choice_label' => fn($position) => $position->getLibelle(),
                'choice_value' => fn($position) => $position ? $position->getId() : '',
                'label' => 'Postes',
                'multiple' => true,
                'expanded' => false,
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary'],
                'label' => 'Sauvegarder'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreatePlayerDTO::class,
            'teams' => [],
            'positions' => [],
        ]);
    }

}
