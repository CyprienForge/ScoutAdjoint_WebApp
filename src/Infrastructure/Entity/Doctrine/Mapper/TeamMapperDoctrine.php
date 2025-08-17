<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Doctrine\ORM\EntityManager;
use Domain\Entity\Team;
use Domain\Mapper\Mapper;
use Domain\Mapper\TeamMapper;
use Domain\Repository\ChampionshipRepository;
use Domain\Repository\TeamRepository;
use Infrastructure\Entity\Doctrine\TeamDoctrine;
use Infrastructure\Repository\Doctrine\TeamRepositoryDoctrine;
use Symfony\Bridge\Doctrine\ManagerRegistry;

/**
 * @implements Mapper<TeamDoctrine, Team>
 */
class TeamMapperDoctrine implements TeamMapper
{
    public function __construct(
        private TeamRepository $teamRepository,
        private ChampionshipRepository $championshipRepository,
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
