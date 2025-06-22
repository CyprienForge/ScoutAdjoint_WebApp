<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Championship;
use Domain\Mapper\Mapper;
use Infrastructure\Entity\Doctrine\ChampionshipDoctrine;

/**
 * @implements Mapper<ChampionshipDoctrine, Championship>
 */
class ChampionshipMapperDoctrine implements Mapper
{
    public static function toDomain($item)
    {
        $championship = new Championship();
        $championship->setId($item->getId());
        $championship->setName($item->getName());
        $championship->setLevel($item->getLevel());
        $championship->setIdentificationCode($item->getIdentificationCode());

        return $championship;
    }

    public static function toInfra($item)
    {
        $championship = new ChampionshipDoctrine();
        $championship->setId($item->getId());
        $championship->setName($item->getName());
        $championship->setLevel($item->getLevel());
        $championship->setIdentificationCode($item->getIdentificationCode());

        return $championship;
    }
}
