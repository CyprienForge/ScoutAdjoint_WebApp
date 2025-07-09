<?php

namespace Domain\Factory;

use Domain\Entity\Championship;
use Domain\Entity\Team;

/**
 * @implements Factory<Team>
 */
class TeamFactory implements Factory
{

    public static function build($attributes)
    {
        $team = new Team();

        $team->setId($attributes['id']);
        $team->setName($attributes['name']);
        $team->setLogoPath($attributes['logo_path']);
        $team->setChampionship($attributes['championship']);

        return $team;
    }
}
