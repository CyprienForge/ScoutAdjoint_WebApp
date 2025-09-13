<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Team;
use Domain\Mapper\Mapper;
use Domain\Mapper\TeamMapper;
use Domain\Repository\Championship\ChampionshipReadRepository;
use Domain\Repository\Championship\ChampionshipRepository;
use Infrastructure\Entity\Doctrine\TeamDoctrine;

/**
 * @implements Mapper<TeamDoctrine, Team>
 */
class TeamMapperDoctrine implements TeamMapper
{
    public function __construct(
        private ChampionshipReadRepository $championshipRepository,
    ){}
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
    public function toInfra($item, ?TeamDoctrine $existingTeamDoctrine = null): TeamDoctrine
    {
        $teamDoctrine = $existingTeamDoctrine ?? new TeamDoctrine();

        $teamDoctrine->setName($item->getName());
        $teamDoctrine->setLogoPath($item->getLogoPath());

        $championshipDoctrine = null;
        if($item->getChampionship() !== null && $item->getChampionship()->getId() !== null){
            $championshipDoctrine = $this->championshipRepository->findById($item->getChampionship()->getId());
        }
        $teamDoctrine->setChampionship($championshipDoctrine);

        return $teamDoctrine;
    }
}
