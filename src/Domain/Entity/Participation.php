<?php

namespace Domain\Entity;

class Participation
{
    public int $id;
    public Player $player;
    public MatchGame $match;
    public Team $team;

    public function getTeam(): Team
    {
        return $this->team;
    }

    public function setTeam(Team $team): Participation
    {
        $this->team = $team;
        return $this;
    }

    public int $numero;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Participation
    {
        $this->id = $id;
        return $this;
    }

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function setPlayer(Player $player): Participation
    {
        $this->player = $player;
        return $this;
    }

    public function getMatch(): MatchGame
    {
        return $this->match;
    }

    public function setMatch(MatchGame $match): Participation
    {
        $this->match = $match;
        return $this;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): Participation
    {
        $this->numero = $numero;
        return $this;
    }
}
