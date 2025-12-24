<?php

namespace Domain\Entity\Player\ValueObject;

use Domain\Exception\Entity\Player\InvalidPlayerBirthDateException;

class PlayerBirthDate
{

    public function __construct(
        private \DateTime $date,
    ){
        if($date > new \DateTime()){
            throw new InvalidPlayerBirthDateException("Birth date cannot be in the future");
        }
    }

    public function value() : \DateTime
    {
        return $this->date;
    }

    public function getYear() : string
    {
        return $this->value()->format('Y');
    }
    public function getAge() : int
    {
        return $this->date->diff(new \DateTime())->y;
    }
}
