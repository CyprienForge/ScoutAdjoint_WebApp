<?php

namespace Domain\Dto\EditPlayer;

use Domain\Entity\Player\Player;
use Domain\Entity\Team;

class EditPlayerDTO
{
    public function __construct(){}

    public int $idPlayer;
    public string $newFirstName;
    public string $newLastName;
    public \DateTime $newBirthDate;
    public int $newTeam;
    public ?ImagePlayerDTO $newImage;
    public array $newPositions;
    public string $newGeneralInfo;

    public static function fromPlayer(Player $player): self
    {
        $dto = new self();
        $dto->idPlayer = $player->getId();
        $dto->newFirstName = $player->getFirstName();
        $dto->newLastName = $player->getLastName();
        $dto->newBirthDate = $player->getBirthDate();
        $dto->newTeam = $player->getTeam()->getId();

        return $dto;
    }

    public function getNewPositions(): array
    {
        return $this->newPositions;
    }

    public function setNewPositions(array $newPositions): EditPlayerDTO
    {
        $this->newPositions = $newPositions;
        return $this;
    }

    public function getIdPlayer(): int
    {
        return $this->idPlayer;
    }

    public function setIdPlayer(int $idPlayer): EditPlayerDTO
    {
        $this->idPlayer = $idPlayer;
        return $this;
    }

    public function getNewFirstName(): string
    {
        return $this->newFirstName;
    }

    public function setNewFirstName(string $newFirstName): EditPlayerDTO
    {
        $this->newFirstName = $newFirstName;
        return $this;
    }

    public function getNewLastName(): string
    {
        return $this->newLastName;
    }

    public function setNewLastName(string $newLastName): EditPlayerDTO
    {
        $this->newLastName = $newLastName;
        return $this;
    }

    public function getNewBirthDate(): \DateTime
    {
        return $this->newBirthDate;
    }

    public function setNewBirthDate(\DateTime $newBirthDate): EditPlayerDTO
    {
        $this->newBirthDate = $newBirthDate;
        return $this;
    }

    public function getNewTeam(): Team
    {
        return $this->newTeam;
    }

    public function setNewTeam(Team $newTeam): EditPlayerDTO
    {
        $this->newTeam = $newTeam;
        return $this;
    }

    public function getNewImage(): ?ImagePlayerDTO
    {
        return $this->newImage;
    }

    public function setNewImage(?ImagePlayerDTO $newImage): EditPlayerDTO
    {
        $this->newImage = $newImage;
        return $this;
    }
}
