<?php

namespace Domain\Repository\MatchInfos;

use Domain\Repository\ReadRepository;

interface MatchInfosReadRepository extends ReadRepository
{
    public function findByMatch(int $idMatch);
}
