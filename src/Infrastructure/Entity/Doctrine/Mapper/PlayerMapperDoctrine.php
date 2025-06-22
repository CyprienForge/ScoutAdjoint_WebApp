<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Player;
use Domain\Mapper\Mapper;
use Infrastructure\Entity\Doctrine\PlayerDoctrine;

/**
 * @implements Mapper<PlayerDoctrine, Player>
 */
class PlayerMapperDoctrine implements Mapper
{

    public static function toDomain($item)
    {
        $player = new Player();
        $player->setId($item->getId());
        $player->setFirstName($item->getFirstName());
        $player->setLastName($item->getLastName());
        $player->setBirthDate($item->getBirthDate());
        $team = TeamMapperDoctrine::toDomain($item->getTeam());
        $player->setTeam($team);
        $player->setIdentificationCode($item->getIdentificationCode());

        return $player;
    }

    public static function toInfra($item)
    {
        $playerDoctrine = new PlayerDoctrine();
        $playerDoctrine->setFirstName($item->getFirstName());
        $playerDoctrine->setLastName($item->getLastName());
        $playerDoctrine->setBirthDate($item->getBirthDate());
        $teamDoctrine =  TeamMapperDoctrine::toInfra($item->getTeam());
        $playerDoctrine->setTeam($teamDoctrine);
        $playerDoctrine->setIdentificationCode($item->getIdentificationCode());

        return $playerDoctrine;
    }
}
