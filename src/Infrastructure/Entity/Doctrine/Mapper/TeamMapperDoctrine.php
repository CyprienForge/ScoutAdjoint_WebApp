<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Team;
use Domain\Mapper\ChampionshipMapper;
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
        private ChampionshipMapper $championshipMapper,
    ){}
    public function toDomain($item)
    {
        $team = new Team();
        $team->setId($item->getId());
        $team->setName($item->getName());
        $team->setLogoPath($item->getLogoPath());

        $championship = $this->championshipMapper->toDomain($item->getChampionship());

        $team->setChampionship($championship);

        return $team;
    }
    public function toInfra($item, ?TeamDoctrine $existingTeamDoctrine = null): TeamDoctrine
    {
        $teamDoctrine = $existingTeamDoctrine ?? new TeamDoctrine();

        $teamDoctrine->setName($item->getName());
        $teamDoctrine->setLogoPath($item->getLogoPath());

        if ($item->getChampionship() !== null && $item->getChampionship()->getId() !== null) {
            $championshipDoctrine = $this->championshipRepository->find($item->getChampionship()->getId());
            if (!$championshipDoctrine) {
                $teamDoctrine = $this->championshipMapper->toInfra($item->getChampionship());
            }

            $teamDoctrine->setChampionship($championshipDoctrine);
        }

        return $teamDoctrine;
    }
}
