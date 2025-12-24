<?php

namespace Domain\Repository\Placement;

use Domain\Entity\Player\ValueObject\PlayerId;
use Domain\Repository\ReadRepository;

interface PlacementReadRepository extends ReadRepository
{
    public function findByPlayer(PlayerId $idPlayer);
}
