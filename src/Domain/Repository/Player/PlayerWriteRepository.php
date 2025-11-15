<?php

namespace Domain\Repository\Player;

use Domain\Repository\WriteRepository;

interface PlayerWriteRepository extends WriteRepository
{
    public function deleteById(int $idPlayer) : void;
    public function getLastInsertId() : int;
}
