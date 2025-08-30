<?php

namespace Domain\Entity;

class MatchInfos
{
    private int $id;
    private MatchGame $match;
    private string $preMatchInfo;
    private string $postMatchInfo;
    private string $homeTeamInfo;
    private string $awayTeamInfo;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): MatchInfos
    {
        $this->id = $id;
        return $this;
    }

    public function getMatch(): MatchGame
    {
        return $this->match;
    }

    public function setMatch(MatchGame $match): MatchInfos
    {
        $this->match = $match;
        return $this;
    }

    public function getPreMatchInfo(): string
    {
        return $this->preMatchInfo;
    }

    public function setPreMatchInfo(?string $preMatchInfo): MatchInfos
    {
        $this->preMatchInfo = $preMatchInfo;
        return $this;
    }

    public function getPostMatchInfo(): string
    {
        return $this->postMatchInfo;
    }

    public function setPostMatchInfo(?string $postMatchInfo): MatchInfos
    {
        $this->postMatchInfo = $postMatchInfo;
        return $this;
    }

    public function getHomeTeamInfo(): string
    {
        return $this->homeTeamInfo;
    }

    public function setHomeTeamInfo(?string $homeTeamInfo): MatchInfos
    {
        $this->homeTeamInfo = $homeTeamInfo;
        return $this;
    }

    public function getAwayTeamInfo(): string
    {
        return $this->awayTeamInfo;
    }

    public function setAwayTeamInfo(?string $awayTeamInfo): MatchInfos
    {
        $this->awayTeamInfo = $awayTeamInfo;
        return $this;
    }
}
