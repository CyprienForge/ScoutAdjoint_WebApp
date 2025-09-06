<?php

namespace Domain\Repository;

use Domain\Response\DeleteUser\DeleteUserResponse;

interface UserRepository extends Repository
{
    public function deleteById(int $id);
    public function findByIdentifier(string $identifier);
    public function findByEmail(string $email);

}
