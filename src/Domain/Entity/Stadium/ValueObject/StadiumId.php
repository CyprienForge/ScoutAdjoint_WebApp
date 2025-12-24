<?php

namespace Domain\Entity\Stadium\ValueObject;

class StadiumId
{

    public function __construct(
        private int $id
    ){
        if($id <= 0){
            throw new \DomainException("StadiumId : id must be greater than 0");
        }
    }

    public function value(): int
    {
        return $this->id;
    }

    public function equals(StadiumId $other): bool
    {
        return $this->id === $other->id;
    }
}
