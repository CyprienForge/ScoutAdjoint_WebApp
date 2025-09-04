<?php

namespace Domain\Repository;

interface UserRepository extends Repository
{

    public function findByIdentifier(string $identifier);
    public function findByEmail(string $email);

}
