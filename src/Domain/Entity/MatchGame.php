<?php

namespace Domain\Entity;

class MatchGame
{
    private int $id;
    private \DateTime $date;
    private int $scoreHome;
    private int $scoreAway;
    private Team $homeTeam;
    private Team $awayTeam;
    private int $idStadium;
    private bool $isPrepared;
    private string $infos;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): MatchGame
    {
        $this->id = $id;
        return $this;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): MatchGame
    {
        $this->date = $date;
        return $this;
    }

    public function getScoreHome(): int
    {
        return $this->scoreHome;
    }

    public function setScoreHome(int $scoreHome): MatchGame
    {
        $this->scoreHome = $scoreHome;
        return $this;
    }

    public function getScoreAway(): int
    {
        return $this->scoreAway;
    }

    public function setScoreAway(int $scoreAway): MatchGame
    {
        $this->scoreAway = $scoreAway;
        return $this;
    }

    public function getHomeTeam(): Team
    {
        return $this->homeTeam;
    }

    public function setHomeTeam(Team $homeTeam): MatchGame
    {
        $this->homeTeam = $homeTeam;
        return $this;
    }

    public function getAwayTeam(): Team
    {
        return $this->awayTeam;
    }

    public function setAwayTeam(Team $awayTeam): MatchGame
    {
        $this->awayTeam = $awayTeam;
        return $this;
    }

    public function getIdStadium(): int
    {
        return $this->idStadium;
    }

    public function setIdStadium(int $idStadium): MatchGame
    {
        $this->idStadium = $idStadium;
        return $this;
    }

    public function isPrepared(): bool
    {
        return $this->isPrepared;
    }

    public function setIsPrepared(bool $isPrepared): MatchGame
    {
        $this->isPrepared = $isPrepared;
        return $this;
    }

    public function getInfos(): string
    {
        return $this->infos;
    }

    public function setInfos(string $infos): MatchGame
    {
        $this->infos = $infos;
        return $this;
    }
}
