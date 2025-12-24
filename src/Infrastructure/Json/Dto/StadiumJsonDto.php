<?php

namespace Infrastructure\Json\Dto;

use Domain\Entity\Stadium\Stadium;
use Domain\Entity\Stadium\ValueObject\StadiumAddress;

class StadiumJsonDto
{
    public int $id;
    public string $street;
    public string $postalCode;
    public string $name;

    public function toDto(Stadium $stadium) : StadiumJsonDto{
        $this->id = $stadium->getId()->value();

        $address = $stadium->getAddress();
        $this->street = $address->getStreet();
        $this->postalCode = $address->getPostalCode();
        $this->name = $stadium->getName()->value();

        return $this;
    }
}
