<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Participation;
use Domain\Mapper\Mapper;
use Domain\Mapper\ParticipationMapper;
use Infrastructure\Entity\Doctrine\ParticipationDoctrine;

class ParticipationMapperDoctrine implements ParticipationMapper
{

    public function toDomain($item)
    {
        $participation = new Participation();
        $participation->setId($item->getId());

        $playerMapperDoctrine = new PlayerMapperDoctrine();
        $participation->setPlayer($playerMapperDoctrine->toDomain($item->getPlayer()));

        $matchMapperDoctrine = new MatchMapperDoctrine();
        $participation->setMatch($matchMapperDoctrine->toDomain($item->getMatch()));
        $participation->setNumero($item->getNumero());

        $teamMapperDoctrine = new TeamMapperDoctrine();
        $participation->setTeam($teamMapperDoctrine->toDomain($item->getTeam()));

        return $participation;
    }

    public function toInfra($item)
    {
        $participationDoctrine = new ParticipationDoctrine();
        $participationDoctrine->setId($item->getId());

        $playerMapperDoctrine = new PlayerMapperDoctrine();
        $participationDoctrine->setPlayer($playerMapperDoctrine->toInfra($item->getPlayer()));

        $matchMapperDoctrine = new MatchMapperDoctrine();
        $participationDoctrine->setMatch($matchMapperDoctrine->toInfra($item->getMatch()));
        $participationDoctrine->setNumero($item->getNumero());

        $teamMapperDoctrine = new TeamMapperDoctrine();
        $participationDoctrine->setTeam($teamMapperDoctrine->toInfra($item->getTeam()));

        return $participationDoctrine;
    }
}
