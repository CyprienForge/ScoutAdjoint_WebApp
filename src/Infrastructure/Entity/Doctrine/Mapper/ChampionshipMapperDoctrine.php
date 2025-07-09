<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Championship;
use Domain\Mapper\ChampionshipMapper;
use Domain\Mapper\Mapper;
use Infrastructure\Entity\Doctrine\ChampionshipDoctrine;

/**
 * @implements Mapper<ChampionshipDoctrine, Championship>
 */
class ChampionshipMapperDoctrine implements ChampionshipMapper
{
    public function toDomain($item)
    {
        $championship = new Championship();
        $championship->setId($item->getId());
        $championship->setName($item->getName());
        $championship->setLevel($item->getLevel());

        return $championship;
    }

    public function toInfra($item)
    {
        $championship = new ChampionshipDoctrine();
        $championship->setId($item->getId());
        $championship->setName($item->getName());
        $championship->setLevel($item->getLevel());

        return $championship;
    }
}
