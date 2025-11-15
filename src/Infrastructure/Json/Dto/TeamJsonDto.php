<?php

namespace Infrastructure\Json\Dto;

use Domain\Entity\Team;

class TeamJsonDto
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $logoPath = null;
    public ?ChampionshipJsonDto $championship = null;
    public function toDto(Team $team): TeamJsonDto
    {
        $championshipJsonDto = new ChampionshipJsonDto();

        $this->id = $team->getId();
        $this->name = $team->getName();
        $this->logoPath = $team->getLogoPath();
        $this->championship = $championshipJsonDto->toDto($team->getChampionship());

        return $this;
    }

}
