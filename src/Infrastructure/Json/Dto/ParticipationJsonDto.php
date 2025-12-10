<?php

namespace Infrastructure\Json\Dto;

use Domain\Entity\Participation;

class ParticipationJsonDto
{
    public int $id;
    public PlayerJsonDto $player;
    public MatchJsonDto $match;
    public TeamJsonDto $team;
    public int $numero;
    public bool $isSubstitute;

    public function toDto(Participation $participation) : ParticipationJsonDto{
        $teamJsonDto = new TeamJsonDto();
        $matchJsonDto = new MatchJsonDto();
        $playerJsonDto = new PlayerJsonDto();

        $this->id = $participation->getId();
        $this->player = $playerJsonDto->toDto($participation->getPlayer());
        $this->match = $matchJsonDto->toDto($participation->getMatch());
        $this->team = $teamJsonDto->toDto($participation->getTeam());
        $this->numero = $participation->getNumero();
        $this->isSubstitute = $participation->isSubstitute();

        return $this;
    }
}
