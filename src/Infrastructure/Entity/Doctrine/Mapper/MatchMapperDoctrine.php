<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\MatchGame;
use Domain\Mapper\ChampionshipMapper;
use Domain\Mapper\Mapper;
use Domain\Mapper\MatchMapper;
use Domain\Mapper\StadiumMapper;
use Domain\Mapper\TeamMapper;
use Domain\Repository\Team\TeamReadRepository;
use Infrastructure\Entity\Doctrine\MatchDoctrine;

class MatchMapperDoctrine implements MatchMapper
{
    public function __construct(
        private TeamMapper $teamMapper,
        private StadiumMapper $stadiumMapper,
        private ChampionshipMapper $championshipMapper,
        private TeamReadRepository $teamReadRepository,
    ){}
    public function toDomain($item)
    {
        $match = new MatchGame();
        $match->setId($item->getId());
        $match->setDate($item->getDate());
        $match->setScoreHome($item->getScoreHome());
        $match->setScoreAway($item->getScoreAway());

        $homeTeam = $this->teamMapper->toDomain($item->getHomeTeam());
        $awayTeam = $this->teamMapper->toDomain($item->getAwayTeam());
        $match->setHomeTeam($homeTeam);
        $match->setAwayTeam($awayTeam);
        $match->setIsPrepared($item->isPrepared());
        $match->setInfos($item->getInfos());
        $match->setStadium($this->stadiumMapper->toDomain($item->getStadium()));
        $match->setChampionship($this->championshipMapper->toDomain($item->getChampionship()));

        return $match;
    }

    public function toInfra($item, ?MatchDoctrine $existing = null)
    {
        $matchDoctrine = $existing ?? new MatchDoctrine();

        $matchDoctrine->setId($item->getId());
        $matchDoctrine->setDate($item->getDate());
        $matchDoctrine->setScoreHome($item->getScoreHome());
        $matchDoctrine->setScoreAway($item->getScoreAway());

        $homeTeamInfra = $this->teamReadRepository->findById($item->getHomeTeam()->getId());
        $awayTeamInfra = $this->teamReadRepository->findById($item->getAwayTeam()->getId());

        $homeTeam = $this->teamMapper->toInfra($homeTeamInfra);
        $awayTeam = $this->teamMapper->toInfra($awayTeamInfra);

        $matchDoctrine->setHomeTeam($homeTeam);
        $matchDoctrine->setAwayTeam($awayTeam);
        $matchDoctrine->setIsPrepared($item->isPrepared());
        $matchDoctrine->setInfos($item->getInfos());
        $matchDoctrine->setStadium($this->stadiumMapper->toInfra($item->getStadium()));

        return $matchDoctrine;
    }
}
