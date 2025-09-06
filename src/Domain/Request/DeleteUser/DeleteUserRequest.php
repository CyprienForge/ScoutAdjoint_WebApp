<?php

namespace Domain\Request\DeleteUser;

use Domain\Entity\User;

class DeleteUserRequest
{

    public function __construct(
        public User $currentUser,
        public int $idUserToDelete
    ){}

}
