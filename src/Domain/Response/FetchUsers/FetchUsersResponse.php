<?php

namespace Domain\Response\FetchUsers;

class FetchUsersResponse
{

    public function __construct(
        public array $users
    ){}

}
