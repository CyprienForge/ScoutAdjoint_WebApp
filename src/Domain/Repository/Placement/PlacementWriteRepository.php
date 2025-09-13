<?php

namespace Domain\Repository\Placement;

use Domain\Repository\WriteRepository;

interface PlacementWriteRepository extends WriteRepository
{
    public function deleteAllByPlayer(int $idPlayer);
}
