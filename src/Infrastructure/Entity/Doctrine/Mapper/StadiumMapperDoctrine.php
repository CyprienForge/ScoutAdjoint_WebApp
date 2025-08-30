<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Stadium;
use Domain\Mapper\StadiumMapper;
use Infrastructure\Entity\Doctrine\StadiumDoctrine;

class StadiumMapperDoctrine implements StadiumMapper
{

    public function toDomain($item)
    {
        $stadium = new Stadium();

        $stadium->setId($item->getId());
        $stadium->setName($item->getName());
        $stadium->setStreet($item->getStreet());
        $stadium->setPostalCode($item->getPostalCode());

        return $stadium;
    }

    public function toInfra($item)
    {
        $stadiumDoctrine = new StadiumDoctrine();

        $stadiumDoctrine->setId($item->getId());
        $stadiumDoctrine->setName($item->getName());
        $stadiumDoctrine->setStreet($item->getStreet());
        $stadiumDoctrine->setPostalCode($item->getPostalCode());

        return $stadiumDoctrine;
    }
}
