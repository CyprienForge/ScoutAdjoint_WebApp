<?php

namespace Domain\Entity\Stadium\ValueObject;

class StadiumName
{

    public function __construct(
        private string $name,
    ){}

    public function value() : string
    {
        return $this->name;
    }
}
