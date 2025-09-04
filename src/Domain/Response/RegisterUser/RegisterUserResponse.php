<?php

namespace Domain\Response\RegisterUser;

use Domain\Entity\User;

class RegisterUserResponse
{
    public function __construct(
        public User $user
    ){}
}
