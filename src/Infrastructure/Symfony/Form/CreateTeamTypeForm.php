<?php

namespace Infrastructure\Symfony\Form;

use Domain\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateTeamTypeForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('championship', ChoiceType::class, [
                'choices' => $options['championships'],
                'choice_label' => fn($championship) => $championship->getName(),
                'choice_value' => fn($championship) => $championship ? $championship->getId() : '',
                'label' => 'Championnat',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Sauvegarder',
                'attr' => ['class' => 'btn btn-primary']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
            'championships' => []
        ]);
    }

}
