<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Player;
use Domain\Mapper\Mapper;
use Domain\Mapper\PlayerMapper;
use Infrastructure\Entity\Doctrine\PlayerDoctrine;

class PlayerMapperDoctrine implements PlayerMapper
{

    public function toDomain($item)
    {
        $player = new Player();
        $player->setId($item->getId());
        $player->setFirstName($item->getFirstName());
        $player->setLastName($item->getLastName());
        $player->setBirthDate($item->getBirthDate());

        $teamMapperDoctrine = new TeamMapperDoctrine();
        $team = $teamMapperDoctrine->toDomain($item->getTeam());

        $player->setTeam($team);
        $player->setIdentificationCode($item->getIdentificationCode());

        return $player;
    }

    public function toInfra($item)
    {
        $playerDoctrine = new PlayerDoctrine();
        $playerDoctrine->setFirstName($item->getFirstName());
        $playerDoctrine->setLastName($item->getLastName());
        $playerDoctrine->setBirthDate($item->getBirthDate());

        $teamMapperDoctrine = new TeamMapperDoctrine();
        $teamDoctrine =  $teamMapperDoctrine->toInfra($item->getTeam());

        $playerDoctrine->setTeam($teamDoctrine);
        $playerDoctrine->setIdentificationCode($item->getIdentificationCode());

        return $playerDoctrine;
    }
}
