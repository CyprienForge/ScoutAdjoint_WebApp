<?php

namespace Domain\Dto\EditGlobalInfosMatch;

use Domain\Entity\MatchInfos;

class EditGlobalInfosMatchDTO
{
    private string $preMatchInfo;
    private string $postMatchInfo;
    private string $homeTeamInfo;
    private string $awayTeamInfo;
    public function getPreMatchInfo(): string
    {
        return $this->preMatchInfo;
    }

    public function setPreMatchInfo(string $preMatchInfo): EditGlobalInfosMatchDTO
    {
        $this->preMatchInfo = $preMatchInfo;
        return $this;
    }

    public function getPostMatchInfo(): string
    {
        return $this->postMatchInfo;
    }

    public function setPostMatchInfo(string $postMatchInfo): EditGlobalInfosMatchDTO
    {
        $this->postMatchInfo = $postMatchInfo;
        return $this;
    }

    public function getHomeTeamInfo(): string
    {
        return $this->homeTeamInfo;
    }

    public function setHomeTeamInfo(string $homeTeamInfo): EditGlobalInfosMatchDTO
    {
        $this->homeTeamInfo = $homeTeamInfo;
        return $this;
    }

    public function getAwayTeamInfo(): string
    {
        return $this->awayTeamInfo;
    }

    public function setAwayTeamInfo(string $awayTeamInfo): EditGlobalInfosMatchDTO
    {
        $this->awayTeamInfo = $awayTeamInfo;
        return $this;
    }

    public static function fromMatchInfos(MatchInfos $matchInfos): EditGlobalInfosMatchDTO
    {
        $self = new self();
        $self->preMatchInfo = $matchInfos->getPreMatchInfo();
        $self->postMatchInfo = $matchInfos->getPostMatchInfo();
        $self->homeTeamInfo = $matchInfos->getHomeTeamInfo();
        $self->awayTeamInfo = $matchInfos->getAwayTeamInfo();

        return $self;
    }
}
