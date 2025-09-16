<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Position;
use Domain\Mapper\PositionMapper;
use Infrastructure\Entity\Doctrine\PositionDoctrine;

class PositionMapperDoctrine implements PositionMapper
{

    public function toDomain($item)
    {
        $position = new Position();
        $position->setId($item->getId());
        $position->setLibelle($item->getLibelle());

        return $position;
    }

    public function toInfra($item, ?PositionDoctrine $existing = null)
    {
        $positionDoctrine = $existing ?? new PositionDoctrine();
        $positionDoctrine->setLibelle($item->getLibelle());

        return $positionDoctrine;
    }
}
