<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\MatchInfos;
use Domain\Mapper\MatchInfosMapper;
use Domain\Mapper\MatchMapper;
use Domain\Repository\Match\MatchReadRepository;
use Infrastructure\Entity\Doctrine\MatchInfosDoctrine;

class MatchInfosMapperDoctrine implements MatchInfosMapper
{
    public function __construct(
        private MatchMapper $matchMapper,
        private MatchReadRepository $matchReadRepository,
    ){}

    public function toDomain($item)
    {
        $matchInfos = new MatchInfos();
        $matchInfos->setId($item->getId());
        $matchInfos->setMatch($this->matchMapper->toDomain($item->getMatch()));
        $matchInfos->setPreMatchInfo($item->getPreMatchInfo());
        $matchInfos->setPostMatchInfo($item->getPostMatchInfo());
        $matchInfos->setHomeTeamInfo($item->getHomeTeamInfo());
        $matchInfos->setAwayTeamInfo($item->getAwayTeamInfo());

        return $matchInfos;
    }

    public function toInfra($item, ?MatchInfosDoctrine $existing = null)
    {
        $matchInfosDoctrine = $existing ?? new MatchInfosDoctrine();

        $match = $this->matchReadRepository->findById($item->getMatch()->getId());
        $matchInfra = $this->matchMapper->toInfra($match);

        $matchInfosDoctrine->setId($item->getId());
        $matchInfosDoctrine->setMatch($matchInfra);
        $matchInfosDoctrine->setPreMatchInfo($item->getPreMatchInfo());
        $matchInfosDoctrine->setPostMatchInfo($item->getPostMatchInfo());
        $matchInfosDoctrine->setHomeTeamInfo($item->getHomeTeamInfo());
        $matchInfosDoctrine->setAwayTeamInfo($item->getAwayTeamInfo());

        return $matchInfosDoctrine;
    }
}
