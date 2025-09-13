<?php

namespace Domain\Repository\Participation;

use Domain\Repository\ReadRepository;

interface ParticipationReadRepository extends ReadRepository
{
    public function findByPlayer(int $idPlayer);
    public function findByMatch(int $idMatch) : array;

    public function findByMatchAndTeam(int $idMatch, int $idTeam) : array;
}
