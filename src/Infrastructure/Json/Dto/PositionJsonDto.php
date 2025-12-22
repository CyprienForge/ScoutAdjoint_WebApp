<?php

namespace Infrastructure\Json\Dto;

use Domain\Entity\Position;

class PositionJsonDto
{
    public int $id;
    public string $libelle;
    public function toDto(Position $position) : PositionJsonDto
    {
        $this->id = $position->getId();
        $this->libelle = $position->getLibelle();
        return $this;
    }

}
