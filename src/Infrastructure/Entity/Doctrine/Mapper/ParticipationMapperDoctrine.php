<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Participation;
use Domain\Mapper\Mapper;
use Domain\Mapper\MatchMapper;
use Domain\Mapper\ParticipationMapper;
use Domain\Mapper\PlayerMapper;
use Domain\Mapper\TeamMapper;
use Infrastructure\Entity\Doctrine\ParticipationDoctrine;

class ParticipationMapperDoctrine implements ParticipationMapper
{
    public function __construct(
        private PlayerMapper $playerMapper,
        private TeamMapper $teamMapper,
        private MatchMapper $matchMapper,
    ){}
    public function toDomain($item)
    {
        $participation = new Participation();
        $participation->setId($item->getId());

        $participation->setPlayer($this->playerMapper->toDomain($item->getPlayer()));

        $participation->setMatch($this->matchMapper->toDomain($item->getMatch()));
        $participation->setNumero($item->getNumero());
        $participation->setIsSubstitute($item->isSubstitute());

        $participation->setTeam($this->teamMapper->toDomain($item->getTeam()));

        return $participation;
    }

    public function toInfra($item)
    {
        $participationDoctrine = new ParticipationDoctrine();
        $participationDoctrine->setId($item->getId());

        $participationDoctrine->setPlayer($this->playerMapper->toInfra($item->getPlayer()));

        $participationDoctrine->setMatch($this->matchMapper->toInfra($item->getMatch()));
        $participationDoctrine->setNumero($item->getNumero());
        $participationDoctrine->setIsSubstitute($item->isSubstitute());

        $participationDoctrine->setTeam($this->teamMapper->toInfra($item->getTeam()));

        return $participationDoctrine;
    }
}
