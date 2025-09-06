<?php

namespace Domain\ViewModel\Entity;

class UserViewModel
{

    public function __construct(
        public int $id,
        public string $identifier,
        public string $email,
        public array $roles,
        public int $positionLoop
    ){}

}
