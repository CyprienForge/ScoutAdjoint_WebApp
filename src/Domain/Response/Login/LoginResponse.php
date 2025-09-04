<?php

namespace Domain\Response\Login;

use Domain\Entity\User;

class LoginResponse
{

    public function __construct(
        public User $user
    ){}

}
