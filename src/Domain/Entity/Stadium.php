<?php

namespace Domain\Entity;

class Stadium
{
    private int $id;
    private string $street;
    private string $postalCode;
    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Stadium
    {
        $this->id = $id;
        return $this;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): Stadium
    {
        $this->street = $street;
        return $this;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): Stadium
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Stadium
    {
        $this->name = $name;
        return $this;
    }
}
