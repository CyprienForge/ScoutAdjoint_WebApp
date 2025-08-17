<?php

namespace Domain\Dto\CreatePlayer;

use Domain\Entity\Team;

class CreatePlayerDTO
{
    public string $firstName;
    public string $lastName;
    public \DateTime $birthDate;
    public ?Team $team = null;
    public array $positions = [];
}
