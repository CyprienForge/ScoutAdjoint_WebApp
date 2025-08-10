<?php

namespace Domain\Repository;

use Domain\Entity\Participation;

/**
 * @implements Repository<Participation>
 */
interface ParticipationRepository extends Repository
{
    public function findByMatch(int $idMatch) : array;

    public function findByMatchAndTeam(int $idMatch, int $idTeam) : array;
}
