<?php

namespace Domain\Request\Login;

class LoginRequest
{

    public function __construct(
        public string $identifier_email,
        public string $password
    ){}

}
