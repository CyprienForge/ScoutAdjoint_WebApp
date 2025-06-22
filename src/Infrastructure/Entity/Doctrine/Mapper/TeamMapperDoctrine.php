<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Team;
use Domain\Mapper\Mapper;
use Infrastructure\Entity\Doctrine\TeamDoctrine;

/**
 * @implements Mapper<TeamDoctrine, Team>
 */
class TeamMapperDoctrine implements Mapper
{
    public static function toDomain($item)
    {
        $team = new Team();
        $team->setId($item->getId());
        $team->setName($item->getName());
        $team->setLogoPath($item->getLogoPath());
        $championship = ChampionshipMapperDoctrine::toDomain($item->getChampionship());
        $team->setChampionship($championship);
        $team->setIdentificationCode($item->getIdentificationCode());

        return $team;
    }
    public static function toInfra($item)
    {
        $teamDoctrine = new TeamDoctrine();
        $teamDoctrine->setId($item->getId());
        $teamDoctrine->setName($item->getName());
        $teamDoctrine->setLogoPath($item->getLogoPath());
        $championshipDoctrine = ChampionshipMapperDoctrine::toInfra($item->getChampionship());
        $teamDoctrine->setChampionship($championshipDoctrine);
        $teamDoctrine->setIdentificationCode($item->getIdentificationCode());

        return $teamDoctrine;
    }
}
