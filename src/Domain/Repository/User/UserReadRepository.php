<?php

namespace Domain\Repository\User;

use Domain\Repository\ReadRepository;

interface UserReadRepository extends ReadRepository
{

    public function findByIdentifier(string $identifier);
    public function findByEmail(string $email);
}
