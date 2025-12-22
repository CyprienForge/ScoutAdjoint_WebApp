<?php

namespace Infrastructure\Json\Dto;

use Domain\Entity\MatchInfos;

class MatchInfosJsonDto
{
    public int $id;
    public MatchJsonDto $match;
    public string $preMatchInfo;
    public string $postMatchInfo;
    public string $homeTeamInfo;
    public string $awayTeamInfo;

    public function toDto(MatchInfos $matchInfos) : MatchInfosJsonDto
    {
        $this->id = $matchInfos->getId();
        $this->preMatchInfo = $matchInfos->getPreMatchInfo();
        $this->postMatchInfo = $matchInfos->getPostMatchInfo();
        $this->homeTeamInfo = $matchInfos->getHomeTeamInfo();
        $this->awayTeamInfo = $matchInfos->getAwayTeamInfo();

        $matchJsonDto = new MatchJsonDto();
        $this->match = $matchJsonDto->toDto($matchInfos->getMatch());

        return $this;
    }
}
