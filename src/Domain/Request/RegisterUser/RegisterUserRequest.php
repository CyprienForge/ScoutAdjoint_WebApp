<?php

namespace Domain\Request\RegisterUser;

class RegisterUserRequest
{
    public function __construct(
        public ?string $identifier,
        public ?string $email,
        public ?string $password,
    ){}
}
