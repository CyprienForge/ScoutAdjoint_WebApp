<?php

namespace Domain\Response\ShowDetailsUser;

use Domain\Entity\User;

class ShowDetailsUserResponse
{

    public function __construct(
        public User $user,
    ){}

}
