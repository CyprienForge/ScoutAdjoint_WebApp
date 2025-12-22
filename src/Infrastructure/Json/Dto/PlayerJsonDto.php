<?php

namespace Infrastructure\Json\Dto;

use DateTime;
use Domain\Entity\Player;

final class PlayerJsonDto
{
    public string $id;
    public string $firstName;
    public string $lastName;
    public string $birthDate;
    public ?TeamJsonDto $team;
    public ?array $positions = [];
    public string $generalNote = "";
    public function toDto(Player $player, array $positions = []): PlayerJsonDto
    {
        $teamJsonDto = new TeamJsonDto();

        $this->id = $player->getId();
        $this->firstName = $player->getFirstName();
        $this->lastName = $player->getLastName();
        $this->birthDate = $player->getBirthDate()->format('Y-m-d');
        $this->team = $player->getTeam() ? $teamJsonDto->toDto($player->getTeam()) : null;
        $this->generalNote = $player->getGeneralNote() ?? "";

        foreach($positions as $position) {
            $this->positions[] = [
                'id' => $position->getId(),
                'libelle' => $position->getLibelle(),
            ];
        }

        return $this;
    }
}
