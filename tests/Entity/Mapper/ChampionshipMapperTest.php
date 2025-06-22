<?php

namespace App\Tests\Entity\Mapper;

use Domain\Entity\Championship;
use Infrastructure\Entity\Doctrine\ChampionshipDoctrine;
use Infrastructure\Entity\Doctrine\Mapper\ChampionshipMapperDoctrine;
use PHPUnit\Framework\TestCase;

class ChampionshipMapperTest extends TestCase
{

    public function testToDomainDoctrine() : void
    {
        $championshipDoctrine = new ChampionshipDoctrine();
        $championshipDoctrine->setId(1);
        $championshipDoctrine->setName('Ligue 1');
        $championshipDoctrine->setLevel(1);
        $championshipDoctrine->setIdentificationCode('123');

        $championship = ChampionshipMapperDoctrine::toDomain($championshipDoctrine);

        $this->assertInstanceOf(Championship::class, $championship);
        $this->assertIsInt($championship->getId());
        $this->assertISstring($championship->getName());
        $this->assertIsInt($championship->getLevel());
    }

    public function testToInfraDoctrine() : void
    {
        $championship = new Championship();
        $championship->setId(1);
        $championship->setName('Ligue 1');
        $championship->setLevel(1);
        $championship->setIdentificationCode('123');

        $championshipDoctrine = ChampionshipMapperDoctrine::toInfra($championship);

        $this->assertInstanceOf(ChampionshipDoctrine::class, $championshipDoctrine);
        $this->assertIsInt($championshipDoctrine->getId());
        $this->assertIsInt($championshipDoctrine->getLevel());
        $this->assertIsString($championshipDoctrine->getName());
    }
}
