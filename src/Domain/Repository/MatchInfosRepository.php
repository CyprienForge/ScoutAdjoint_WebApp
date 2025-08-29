<?php

namespace Domain\Repository;

interface MatchInfosRepository extends Repository
{
    public function findByMatch(int $idMatch);
}
