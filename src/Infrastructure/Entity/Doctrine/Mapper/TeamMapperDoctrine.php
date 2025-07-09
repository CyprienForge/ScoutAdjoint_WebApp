<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Team;
use Domain\Mapper\Mapper;
use Domain\Mapper\TeamMapper;
use Infrastructure\Entity\Doctrine\TeamDoctrine;

/**
 * @implements Mapper<TeamDoctrine, Team>
 */
class TeamMapperDoctrine implements TeamMapper
{
    public function toDomain($item)
    {
        $team = new Team();
        $team->setId($item->getId());
        $team->setName($item->getName());
        $team->setLogoPath($item->getLogoPath());

        $championshipMapperDoctrine = new ChampionshipMapperDoctrine();
        $championship = $championshipMapperDoctrine->toDomain($item->getChampionship());

        $team->setChampionship($championship);

        return $team;
    }
    public function toInfra($item)
    {
        $teamDoctrine = new TeamDoctrine();
        $teamDoctrine->setId($item->getId());
        $teamDoctrine->setName($item->getName());
        $teamDoctrine->setLogoPath($item->getLogoPath());

        $championshipDoctrineMapper = new ChampionshipMapperDoctrine();
        $championshipDoctrine = $championshipDoctrineMapper->toInfra($item->getChampionship());

        $teamDoctrine->setChampionship($championshipDoctrine);

        return $teamDoctrine;
    }
}
