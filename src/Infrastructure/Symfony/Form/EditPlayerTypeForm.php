<?php

namespace Infrastructure\Symfony\Form;

use Domain\Entity\Team;
use Infrastructure\Entity\Doctrine\TeamDoctrine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
            ->add('first_name', TextType::class, [
                'required' => false,
                'label' => 'Prénom'
            ])
            ->add('last_name', TextType::class, [
                'required' => false,
                'label' => 'Nom'
            ])
            ->add('birth_date', DateType::class, [
                'required' => false,
                'label' => 'Date de naissance',
            ])
            ->add('team', EntityType::class, [
                'class' => TeamDoctrine::class,
                'autocomplete' => true,
            ])
            ->add('image', FileType::class, [
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
            // Configure your form options here
        ]);
    }
}
