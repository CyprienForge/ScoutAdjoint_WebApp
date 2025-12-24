<?php

namespace Domain\Entity\Player\ValueObject;

class PlayerId
{

    public function __construct(
      private int $id,
    ){}

    public function value(): int
    {
        return $this->id;
    }
}
