<?php

namespace Domain\Repository\Participation;

use Domain\Entity\Player\ValueObject\PlayerId;
use Domain\Repository\ReadRepository;

interface ParticipationReadRepository extends ReadRepository
{
    public function findByPlayer(PlayerId $idPlayer);
    public function findByMatch(int $idMatch) : array;

    public function findByMatchAndTeam(int $idMatch, int $idTeam) : array;
}
