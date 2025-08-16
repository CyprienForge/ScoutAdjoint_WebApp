<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Doctrine\ORM\EntityManager;
use Domain\Entity\Team;
use Domain\Mapper\Mapper;
use Domain\Mapper\TeamMapper;
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
        $teamDoctrine = $existingTeamDoctrine;

        if ($teamDoctrine === null) {
            if ($item->getId() !== null) {
                $teamDoctrine = $this->teamRepository->find($item->getId());
                if (!$teamDoctrine) {
                    throw new \Exception("TeamDoctrine not found for id " . $item->getId());
                }
            } else {
                $teamDoctrine = new TeamDoctrine();
            }
        }

        $teamDoctrine->setName($item->getName());
        $teamDoctrine->setLogoPath($item->getLogoPath());

        $championshipDoctrineMapper = new ChampionshipMapperDoctrine();
        $existingChampionshipDoctrine = $teamDoctrine->getChampionship();
        $championshipDoctrine = $championshipDoctrineMapper->toInfra($item->getChampionship(), $existingChampionshipDoctrine);
        $teamDoctrine->setChampionship($championshipDoctrine);

        return $teamDoctrine;
    }
}
