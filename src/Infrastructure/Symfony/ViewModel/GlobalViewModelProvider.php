<?php

namespace Infrastructure\Symfony\ViewModel;

use Domain\ViewModel\GlobalViewModel;
use Symfony\Bundle\SecurityBundle\Security;

class GlobalViewModelProvider
{
    public function __construct(private Security $security){}

    public function getGlobalViewModel(): GlobalViewModel
    {
        $user = $this->security->getUser();
        return new GlobalViewModel(
            $user !== null,
            $user?->getIdentifier(),
        );
    }
}
