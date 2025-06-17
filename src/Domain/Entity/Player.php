<?php

namespace Domain\Entity;

class Player
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $birthDate;
    private Team $team;
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function setBirthDate(string $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public function getTeam(): Team
    {
        return $this->team;
    }

    public function setTeam(Team $team): void
    {
        $this->team = $team;
    }
}
