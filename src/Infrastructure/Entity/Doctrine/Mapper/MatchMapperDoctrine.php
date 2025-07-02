<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\MatchGame;
use Domain\Mapper\Mapper;
use Domain\Mapper\MatchMapper;
use Infrastructure\Entity\Doctrine\MatchDoctrine;

class MatchMapperDoctrine implements MatchMapper
{
    public function toDomain($item)
    {
        $match = new MatchGame();
        $match->setId($item->getId());
        $match->setDate($item->getDate());
        $match->setScoreHome($item->getScoreHome());
        $match->setScoreAway($item->getScoreAway());

        $teamMapperDoctrine = new TeamMapperDoctrine();
        $homeTeam = $teamMapperDoctrine->toDomain($item->getHomeTeam());
        $awayTeam = $teamMapperDoctrine->toDomain($item->getAwayTeam());
        $match->setHomeTeam($homeTeam);
        $match->setAwayTeam($awayTeam);
        $match->setIsPrepared($item->isPrepared());
        $match->setInfos($item->getInfos());
        $match->setIdentificationCode($item->getIdentificationCode());

        return $match;
    }

    public function toInfra($item)
    {
        $matchDoctrine = new MatchDoctrine();
        $matchDoctrine->setId($item->getId());
        $matchDoctrine->setDate($item->getDate());
        $matchDoctrine->setScoreHome($item->getScoreHome());
        $matchDoctrine->setScoreAway($item->getScoreAway());

        $teamMapperDoctrine = new TeamMapperDoctrine();
        $homeTeam = $teamMapperDoctrine->toInfra($item->getHomeTeam());
        $awayTeam = $teamMapperDoctrine->toInfra($item->getAwayTeam());
        $matchDoctrine->setHomeTeam($homeTeam);
        $matchDoctrine->setAwayTeam($awayTeam);
        $matchDoctrine->setIsPrepared($item->isPrepared());
        $matchDoctrine->setInfos($item->getInfos());
        $matchDoctrine->setIdentificationCode($item->getIdentificationCode());

        return $matchDoctrine;
    }
}
