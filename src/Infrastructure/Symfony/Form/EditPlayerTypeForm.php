<?php

namespace Infrastructure\Symfony\Form;

use App\Domain\Entity\Position;
use Domain\Dto\EditPlayer\EditPlayerDTO;
use Domain\Entity\Team;
use Infrastructure\Entity\Doctrine\PositionDoctrine;
use Infrastructure\Entity\Doctrine\TeamDoctrine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditPlayerTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('newFirstName', TextType::class, [
                'required' => false,
                'label' => 'Prénom'
            ])
            ->add('newLastName', TextType::class, [
                'required' => false,
                'label' => 'Nom'
            ])
            ->add('newBirthDate', DateType::class, [
                'required' => false,
                'label' => 'Date de naissance',
            ])
            ->add('newTeam', ChoiceType::class, [
                'choices' => $options['teams'],
                'choice_label' => fn($team) => $team->getName(),
                'choice_value' => fn($team) => $team ? $team->getId() : '',
                'label' => 'Équipes',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('newPositions', ChoiceType::class, [
                'choices' => $options['positions'],
                'choice_label' => fn($position) => $position->getLibelle(),
                'choice_value' => fn($position) => $position ? $position->getId() : '',
                'label' => 'Postes',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('newImage', FileType::class, [
                'label' => false,
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'accept' => 'image/*',
                    'style' => 'display:none;',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EditPlayerDTO::class,
            'teams' => [],
            'positions' => [],
        ]);
    }
}
