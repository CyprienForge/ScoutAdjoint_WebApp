<?php

namespace Domain\Factory;


use Domain\Entity\Championship;

/**
 * @implements Factory<Championship>
 */
class ChampionshipFactory implements Factory
{

    public static function build($attributes)
    {
        $championship = new Championship();
        $championship->setId($attributes['id']);
        $championship->setName($attributes['name']);
        $championship->setLevel($attributes['level']);
        $championship->setIdentificationCode($attributes['identification_code']);

        return $championship;
    }
}
