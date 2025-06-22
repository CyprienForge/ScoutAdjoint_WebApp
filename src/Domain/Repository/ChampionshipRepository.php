<?php

namespace Domain\Repository;

use Domain\Entity\Championship;
use Infrastructure\Entity\Doctrine\ChampionshipDoctrine;

/**
 * @implements Repository<Championship>
 */
interface ChampionshipRepository extends Repository
{
    public function findByName(string $name) : ?ChampionshipDoctrine;
}
