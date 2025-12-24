<?php

namespace Infrastructure\Json\Dto;

use Domain\Entity\Player\Player;

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

        $this->id = $player->getId()->value();
        $this->firstName = $player->getName()->firstName();
        $this->lastName = $player->getName()->lastName();
        $this->birthDate = $player->getBirthDate()->value()->format('Y-m-d');
        $this->team = $player->getTeam() ? $teamJsonDto->toDto($player->getTeam()) : null;
        $this->generalNote = $player->getGeneralNote()->value() ?? "";

        foreach($positions as $position) {
            $this->positions[] = [
                'id' => $position->getId(),
                'libelle' => $position->getLibelle(),
            ];
        }

        return $this;
    }
}
