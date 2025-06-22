<?php

namespace App\Tests\Entity\Mapper;

use Domain\Entity\Championship;
use Domain\Entity\Team;
use Infrastructure\Entity\Doctrine\ChampionshipDoctrine;
use Infrastructure\Entity\Doctrine\Mapper\TeamMapperDoctrine;
use Infrastructure\Entity\Doctrine\TeamDoctrine;
use PHPUnit\Framework\TestCase;

class TeamMapperTest extends TestCase
{

    public function testToDomainDoctrine() : void
    {
        $teamDoctrine = new TeamDoctrine();
        $teamDoctrine->setId(1);
        $teamDoctrine->setName('ASSE');
        $teamDoctrine->setLogoPath(null);
        $teamDoctrine->setChampionship(((new ChampionshipDoctrine())->setId(1)->setName('Ligue 1')->setLevel(1)->setIdentificationCode('123')));
        $teamDoctrine->setIdentificationCode('123');

        $team = TeamMapperDoctrine::toDomain($teamDoctrine);

        $this->assertInstanceOf(Team::class, $team);
        $this->assertInstanceOf(Championship::class, $team->getChampionship());
        $this->assertIsInt($team->getId());
        $this->assertNull($team->getLogoPath());
    }


    public function testToInfra() : void
    {
        $team = new Team();
        $team->setId(1);
        $team->setName('ASSE');
        $team->setLogoPath(null);
        $team->setChampionship((new Championship())->setId(1)->setName('Ligue 1')->setLevel(1)->setIdentificationCode('123'));
        $team->setIdentificationCode('123');

        $teamDoctrine = TeamMapperDoctrine::toInfra($team);

        $this->assertInstanceOf(TeamDoctrine::class, $teamDoctrine);
        $this->assertInstanceOf(ChampionshipDoctrine::class, $teamDoctrine->getChampionship());
        $this->assertIsInt($team->getId());
        $this->assertIsString($team->getName());
        $this->assertNull($team->getLogoPath());
    }
}
