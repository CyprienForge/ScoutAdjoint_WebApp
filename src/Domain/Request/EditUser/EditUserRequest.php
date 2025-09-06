<?php

namespace Domain\Request\EditUser;

use Domain\Entity\User;

class EditUserRequest
{

    public function __construct(
        public User $user,
        public array $newRoles,
        public int $idCurrentUser
    ){}

}
