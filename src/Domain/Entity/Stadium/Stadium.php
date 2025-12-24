<?php

namespace Domain\Entity\Stadium;

use Domain\Entity\Stadium\ValueObject\StadiumAddress;
use Domain\Entity\Stadium\ValueObject\StadiumId;
use Domain\Entity\Stadium\ValueObject\StadiumName;

class Stadium
{
    private StadiumId $id;
    private StadiumAddress $address;
    private StadiumName $name;

    public function __construct(
        StadiumId $id,
        StadiumAddress $address,
        StadiumName $name,
    ){
        $this->id = $id;
        $this->address = $address;
        $this->name = $name;
    }

    public function relocate(StadiumAddress $address) : Stadium
    {
        $this->address = $address;
        return $this;
    }

    public function rename(StadiumName $name) : Stadium
    {
        $this->name = $name;
        return $this;
    }

    public function getAddress(): StadiumAddress
    {
        return $this->address;
    }

    public function getId(): StadiumId
    {
        return $this->id;
    }

    public function getName() : StadiumName
    {
        return $this->name;
    }
}
