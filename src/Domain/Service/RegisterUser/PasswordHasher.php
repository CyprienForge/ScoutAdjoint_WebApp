<?php

namespace Domain\Service\RegisterUser;

interface PasswordHasher
{
    public function hash(string $password): string;
    public function verify(string $password, string $passwordHash) : bool;

}
