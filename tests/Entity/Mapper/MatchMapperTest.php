<?php

namespace App\Tests\Entity\Mapper;

use Domain\Entity\Championship;
use Domain\Entity\MatchGame;
use Domain\Entity\Team;
use Infrastructure\Entity\Doctrine\ChampionshipDoctrine;
use Infrastructure\Entity\Doctrine\Mapper\MatchMapperDoctrine;
use Infrastructure\Entity\Doctrine\MatchDoctrine;
use Infrastructure\Entity\Doctrine\TeamDoctrine;
use PHPUnit\Framework\TestCase;

class MatchMapperTest extends TestCase
{

    public function testToDomain()
    {
        $championshipDoctrine = (new ChampionshipDoctrine())->setId(1)->setName('Championship')->setLevel(1)->setIdentificationCode('123');
        $team = (new TeamDoctrine())->setId(1)->setName('ASSE')->setIdentificationCode('123')->setChampionship($championshipDoctrine);

        $matchDoctrine = (new MatchDoctrine())->setId(1)->setDate(new \DateTime())->setScoreHome(1)->setScoreAway(2)->setHomeTeam($team)->setAwayTeam($team)->setIsPrepared(false)->setInfos('Noé Marjolet')->setIdentificationCode('Hugo Spery');
        $match = MatchMapperDoctrine::toDomain($matchDoctrine);

        $this->assertInstanceOf(MatchGame::class, $match);
        $this->assertIsInt($match->getId());
        $this->assertInstanceOf(\DateTime::class, $match->getDate());
        $this->assertIsInt($match->getScoreHome());
        $this->assertIsInt($match->getScoreAway());
        $this->assertInstanceOf(Team::class, $match->getHomeTeam());
        $this->assertInstanceOf(Team::class, $match->getAwayTeam());
        $this->assertIsBool($match->isPrepared());
        $this->assertIsString($match->getInfos());
        $this->assertIsString($match->getIdentificationCode());
    }

    public function testToInfra()
    {
        $championship = (new Championship())->setId(1)->setName('Ligue 1')->setLevel(1)->setIdentificationCode('123');
        $team = (new Team())->setId(1)->setName('ASSE')->setIdentificationCode('123')->setLogoPath('')->setChampionship($championship);
        $match = (new MatchGame())->setId(1)->setDate(new \DateTime())->setScoreHome(1)->setScoreAway(2)->setHomeTeam($team)->setAwayTeam($team)->setIsPrepared(true)->setInfos('Lucas Durand')->setIdentificationCode('Ping-Pong');
        $matchDoctrine = MatchMapperDoctrine::toInfra($match);

        $this->assertInstanceOf(MatchDoctrine::class, $matchDoctrine);
        $this->assertIsInt($matchDoctrine->getId());
        $this->assertInstanceOf(\DateTime::class, $matchDoctrine->getDate());
        $this->assertIsInt($matchDoctrine->getScoreHome());
        $this->assertIsInt($matchDoctrine->getScoreAway());
        $this->assertInstanceOf(TeamDoctrine::class, $matchDoctrine->getHomeTeam());
        $this->assertInstanceOf(TeamDoctrine::class, $matchDoctrine->getAwayTeam());
        $this->assertIsBool($matchDoctrine->isPrepared());
        $this->assertIsString($matchDoctrine->getInfos());
        $this->assertIsString($matchDoctrine->getIdentificationCode());
    }
}
