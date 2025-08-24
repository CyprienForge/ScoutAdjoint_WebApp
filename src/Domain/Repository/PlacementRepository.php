<?php

namespace Domain\Repository;

use Domain\Repository\Repository;

interface PlacementRepository extends Repository
{

    public function findByPlayer(int $idPlayer);
    public function deleteAllByPlayer(int $idPlayer);

}
