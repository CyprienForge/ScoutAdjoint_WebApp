<?php

namespace Domain\Repository\Placement;

use Domain\Repository\ReadRepository;

interface PlacementReadRepository extends ReadRepository
{
    public function findByPlayer(int $idPlayer);
}
