<?php

namespace Domain\Dto\CreatePlayer;

use Domain\Entity\Team;

class CreatePlayerDTO
{
    public string $firstName;
    public string $lastName;
    public \DateTime $birthDate;
    public ?int $idTeam = null;
    public array $positions = [];
    public function setFirstName(string $firstName): CreatePlayerDTO
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function setLastName(string $lastName): CreatePlayerDTO
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function setBirthDate(\DateTime $birthDate): CreatePlayerDTO
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function setIdTeam(?int $idTeam): CreatePlayerDTO
    {
        $this->idTeam = $idTeam;
        return $this;
    }

    public function setPositions(array $positions): CreatePlayerDTO
    {
        $this->positions = $positions;
        return $this;
    }
}
