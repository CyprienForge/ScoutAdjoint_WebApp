<?php

namespace Infrastructure\Service\Symfony;

use Domain\Service\Logout\LogoutService;
use Symfony\Bundle\SecurityBundle\Security;

class SymfonyLogoutService implements LogoutService
{

    public function __construct(private Security $security) {}

    public function logout(): void
    {
        $this->security->logout();
    }

}
