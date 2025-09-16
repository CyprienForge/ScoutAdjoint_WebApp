<?php

namespace Domain\Entity;

use Domain\Entity\Position;

class Placement
{
    private ?int $id = null;
    private Player $player;
    private Position $position;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Placement
    {
        $this->id = $id;
        return $this;
    }

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function setPlayer(Player $player): Placement
    {
        $this->player = $player;
        return $this;
    }

    public function getPosition(): Position
    {
        return $this->position;
    }

    public function setPosition(Position $position): Placement
    {
        $this->position = $position;
        return $this;
    }

}
