<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Stadium\Stadium;
use Domain\Entity\Stadium\ValueObject\StadiumAddress;
use Domain\Entity\Stadium\ValueObject\StadiumId;
use Domain\Entity\Stadium\ValueObject\StadiumName;
use Domain\Mapper\StadiumMapper;
use Infrastructure\Entity\Doctrine\StadiumDoctrine;

class StadiumMapperDoctrine implements StadiumMapper
{

    public function toDomain($item)
    {

        $id = new StadiumId($item->getId());
        $address = new StadiumAddress(
            $item->getPostalCode(),
            $item->getStreet(),
            ""
        );
        $name = new StadiumName($item->getName());

        $stadium = new Stadium(
          $id,
          $address,
          $name
        );
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
