<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Participation;
use Domain\Mapper\Mapper;
use Infrastructure\Entity\Doctrine\ParticipationDoctrine;

class ParticipationMapperDoctrine implements Mapper
{

    public static function toDomain($item)
    {
        $participation = new Participation();
        $participation->setId($item->getId());
        $participation->setPlayer(PlayerMapperDoctrine::toDomain($item->getPlayer()));
        $participation->setMatch(MatchMapperDoctrine::toDomain($item->getMatch()));
        $participation->setNumero($item->getNumero());
        $participation->setTeam(TeamMapperDoctrine::toDomain($item->getTeam()));

        return $participation;
    }

    public static function toInfra($item)
    {
        $participationDoctrine = new ParticipationDoctrine();
        $participationDoctrine->setId($item->getId());
        $participationDoctrine->setPlayer(PlayerMapperDoctrine::toInfra($item->getPlayer()));
        $participationDoctrine->setMatch(MatchMapperDoctrine::toInfra($item->getMatch()));
        $participationDoctrine->setNumero($item->getNumero());
        $participationDoctrine->setTeam(TeamMapperDoctrine::toInfra($item->getTeam()));

        return $participationDoctrine;
    }
}
