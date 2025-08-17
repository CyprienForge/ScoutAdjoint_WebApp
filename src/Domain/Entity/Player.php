<?php

namespace Domain\Entity;

class Player
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private \DateTime $birthDate;
    private Team $team;
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Player
    {
        $this->id = $id;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): Player
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): Player
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getBirthDate(): \DateTime
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTime $birthDate): Player
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function getTeam(): Team
    {
        return $this->team;
    }

    public function setTeam(Team $team): Player
    {
        $this->team = $team;
        return $this;
    }
}
