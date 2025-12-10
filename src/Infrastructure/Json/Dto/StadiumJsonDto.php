<?php

namespace Infrastructure\Json\Dto;

use Domain\Entity\Stadium;

class StadiumJsonDto
{
    public int $id;
    public string $street;
    public string $postalCode;
    public string $name;

    public function toDto(Stadium $stadium) : StadiumJsonDto{
        $this->id = $stadium->getId();
        $this->street = $stadium->getStreet();
        $this->postalCode = $stadium->getPostalCode();
        $this->name = $stadium->getName();

        return $this;
    }
}
