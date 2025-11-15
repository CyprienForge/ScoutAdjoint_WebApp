<?php

namespace Infrastructure\Symfony\Form\MergePlayer;

use Infrastructure\Entity\Doctrine\PlayerDoctrine;
use Infrastructure\Repository\Doctrine\Player\PlayerReadRepositoryDoctrine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class MergePlayerAutocompleteField extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => PlayerDoctrine::class,
            'placeholder' => 'Choissisez un nom dans la liste',
            'choice_label' => 'lastName',

            'query_builder' => function(PlayerReadRepositoryDoctrine $playerReadRepository) {
                return $playerReadRepository->createQueryBuilder('p');
            },
            //'security' => 'ROLE_SOMETHING',
        ]);
    }

}
