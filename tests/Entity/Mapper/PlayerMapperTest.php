<?php

namespace App\Tests\Entity\Mapper;

use Domain\Entity\Player;
use Domain\Entity\Team;
use Domain\Factory\ChampionshipFactory;
use Infrastructure\Entity\Doctrine\ChampionshipDoctrine;
use Infrastructure\Entity\Doctrine\Mapper\PlayerMapperDoctrine;
use Infrastructure\Entity\Doctrine\Mapper\TeamMapperDoctrine;
use Infrastructure\Entity\Doctrine\PlayerDoctrine;
use Infrastructure\Entity\Doctrine\TeamDoctrine;
use PHPUnit\Framework\TestCase;

class PlayerMapperTest extends TestCase
{

    public function testToDomain()
    {
        $championshipDoctrine = (new ChampionshipDoctrine())->setId(1)->setName('Championship')->setLevel(1)->setIdentificationCode('123');

        $playerDoctrine = new PlayerDoctrine();
        $playerDoctrine->setId(1);
        $playerDoctrine->setFirstName('Lucas');
        $playerDoctrine->setLastName('Sanchez');
        $playerDoctrine->setBirthDate(new \DateTime());
        $playerDoctrine->setIdentificationCode('123');
        $playerDoctrine->setTeam((new TeamDoctrine())->setId(1)->setName('ASSE')->setIdentificationCode('123')->setChampionship($championshipDoctrine));
        $player = PlayerMapperDoctrine::toDomain($playerDoctrine);

        $this->assertInstanceOf(Player::class, $player);
    }

}
