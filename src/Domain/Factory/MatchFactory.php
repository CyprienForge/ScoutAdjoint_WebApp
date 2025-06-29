<?php

namespace Domain\Factory;

use Domain\Entity\MatchGame;

class MatchFactory implements Factory
{

    public static function build($attributes)
    {
        $match = new MatchGame();
        $match->setId($attributes['id']);
        $date = new \DateTime($attributes['date']);
        $match->setDate($date);
        $match->setScoreHome($attributes['score_home']);
        $match->setScoreAway($attributes['score_away']);
        $match->setHomeTeam($attributes['home_team']);
        $match->setAwayTeam($attributes['away_team']);
        $match->setIdStadium($attributes['stadium']);
        $match->setIsPrepared($attributes['is_prepared']);
        $match->setInfos($attributes['infos']);
        $match->setIdentificationCode($attributes['identification_code']);

        return $match;
    }
}
