<?php

namespace Domain\Entity;

class Championship
{
    private int $id;
    private string $name;
    private ?int $level;
    private string $identificationCode;
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Championship
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Championship
    {
        $this->name = $name;
        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): Championship
    {
        $this->level = $level;
        return $this;
    }

    public function getIdentificationCode(): string
    {
        return $this->identificationCode;
    }

    public function setIdentificationCode(string $identificationCode): Championship
    {
        $this->identificationCode = $identificationCode;
        return $this;
    }
}
