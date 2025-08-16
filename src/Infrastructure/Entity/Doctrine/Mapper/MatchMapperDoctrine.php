<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\MatchGame;
use Domain\Mapper\Mapper;
use Domain\Mapper\MatchMapper;
use Domain\Mapper\TeamMapper;
use Infrastructure\Entity\Doctrine\MatchDoctrine;

class MatchMapperDoctrine implements MatchMapper
{
    public function __construct(
        private TeamMapper $teamMapper,
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

        return $match;
    }

    public function toInfra($item)
    {
        $matchDoctrine = new MatchDoctrine();
        $matchDoctrine->setId($item->getId());
        $matchDoctrine->setDate($item->getDate());
        $matchDoctrine->setScoreHome($item->getScoreHome());
        $matchDoctrine->setScoreAway($item->getScoreAway());

        $homeTeam = $this->teamMapper->toInfra($item->getHomeTeam());
        $awayTeam = $this->teamMapper->toInfra($item->getAwayTeam());
        $matchDoctrine->setHomeTeam($homeTeam);
        $matchDoctrine->setAwayTeam($awayTeam);
        $matchDoctrine->setIsPrepared($item->isPrepared());
        $matchDoctrine->setInfos($item->getInfos());

        return $matchDoctrine;
    }
}
