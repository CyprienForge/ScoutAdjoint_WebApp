<?php

namespace Infrastructure\Json\Dto;

use Domain\Entity\Championship;

class ChampionshipJsonDto
{
    public int $id;
    public string $name;
    public ?int $level;

    public function toDto(Championship $championship): ChampionshipJsonDto
    {
        $this->id = $championship->getId();
        $this->name = $championship->getName();
        $this->level = $championship->getLevel();

        return $this;
    }
}
