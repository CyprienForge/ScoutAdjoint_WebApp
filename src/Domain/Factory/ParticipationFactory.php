<?php

namespace Domain\Factory;

use Domain\Entity\Participation;

class ParticipationFactory implements Factory
{
    public static function build($attributes)
    {
        $participation = new Participation();
        $participation->setId($attributes['id']);
        $participation->setPlayer($attributes['player']);
        $participation->setMatch($attributes['match']);
        $participation->setNumero($attributes['numero']);
        $participation->setTeam($attributes['team']);

        return $participation;
    }
}
