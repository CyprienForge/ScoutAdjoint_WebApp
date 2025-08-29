<?php

namespace Infrastructure\Symfony\Form;

use Domain\Dto\EditGlobalInfosMatch\EditGlobalInfosMatchDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditGlobalInfosMatchTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('preMatchInfo', TextareaType::class, [
                'required' => false,
                'label' => "Infos d'avant-match : ",
                'empty_data' => '',
            ])
            ->add('homeTeamInfo', TextareaType::class, [
                'required' => false,
                'label' => "Remarque équipe domicile : ",
                'empty_data' => '',
            ])
            ->add('awayTeamInfo', TextareaType::class, [
                'required' => false,
                'label' => "Remarque équipe exérieure : ",
                'empty_data' => '',
            ])
            ->add('postMatchInfo', TextareaType::class, [
                'required' => false,
                'label' => "Remarque d'après-match : ",
                'empty_data' => '',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EditGlobalInfosMatchDTO::class
        ]);
    }
}
