<?php

namespace Infrastructure\Json\Dto;

use Domain\Entity\MatchGame;

class MatchJsonDto
{
    public int $id;
    public string $date;
    public int $scoreHome;
    public int $scoreAway;
    public TeamJsonDto $homeTeam;
    public TeamJsonDto $awayTeam;
    public bool $isPrepared;
    public string $infos;
    public StadiumJsonDto $stadium;
    public ChampionshipJsonDto $championship;

    public function toDto(MatchGame $match) : matchJsonDto{
        $homeTeamJsonDto = new TeamJsonDto();
        $awayTeamJsonDto = new TeamJsonDto();
        $stadiumJsonDto = new StadiumJsonDto();
        $championshipJsonDto = new ChampionshipJsonDto();

        $this->id = $match->getId();
        $this->date = $match->getDate()->format('Y-m-d');
        $this->scoreHome = $match->getScoreHome();
        $this->scoreAway = $match->getScoreAway();
        $this->homeTeam = $homeTeamJsonDto->toDto($match->getHomeTeam());
        $this->awayTeam = $awayTeamJsonDto->toDto($match->getAwayTeam());
        $this->isPrepared = $match->isPrepared();
        $this->infos = $match->getInfos();
        $this->stadium = $stadiumJsonDto->toDto($match->getStadium());
        $this->championship = $championshipJsonDto->toDto($match->getChampionship());

        return $this;
    }
}
