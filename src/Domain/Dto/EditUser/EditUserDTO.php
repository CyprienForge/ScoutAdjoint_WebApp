<?php

namespace Domain\Dto\EditUser;

class EditUserDTO
{
    public function __construct(
        public array $roles
    ){}

}
