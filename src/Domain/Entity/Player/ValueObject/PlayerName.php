<?php

namespace Domain\Entity\Player\ValueObject;

use Domain\Exception\Entity\Player\InvalidPlayerNameException;

class PlayerName
{

    public function __construct(
        private string $firstName,
        private string $lastName
    ){
        if($firstName === '' || $firstName === null) {
            throw new InvalidPlayerNameException("First name can't be empty");
        }

        if($lastName === '' || $lastName === null) {
            throw new InvalidPlayerNameException("Last name can't be empty");
        }
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function fullName() : string
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
