<?php

namespace Domain\Entity\Stadium\ValueObject;

class StadiumAddress
{

    public function __construct(
        private string $postalCode,
        private string $street,
        private string $city
    ){}

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function fullAddress() : string
    {
        return $this->city . ' - ' . $this->postalCode . ' ' . $this->street;
    }
}
