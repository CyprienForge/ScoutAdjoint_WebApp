<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\MatchInfos;
use Domain\Mapper\MatchInfosMapper;
use Domain\Mapper\MatchMapper;
use Domain\Repository\Match\MatchReadRepository;
use Domain\Repository\Match\MatchRepository;
use Domain\Repository\MatchInfos\MatchInfosReadRepository;
use Domain\Repository\MatchInfos\MatchInfosRepository;
use Infrastructure\Entity\Doctrine\MatchInfosDoctrine;

class MatchInfosMapperDoctrine implements MatchInfosMapper
{
    public function __construct(
        private MatchMapper $matchMapper,
        private MatchReadRepository $matchRepository,
        private MatchInfosReadRepository $matchInfosRepository,
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

    public function toInfra($item)
    {
        $matchInfosDoctrine = $this->matchInfosRepository->findByMatch($item->getMatch()->getId());
        if (!$matchInfosDoctrine) {
            $matchInfosDoctrine = new MatchInfosDoctrine();
            $matchDoctrine = $this->matchRepository->findById($item->getMatch()->getId());
            $matchInfosDoctrine->setMatch($matchDoctrine);
        }

        $matchInfosDoctrine->setId($item->getId());
        $matchInfosDoctrine->setPreMatchInfo($item->getPreMatchInfo());
        $matchInfosDoctrine->setPostMatchInfo($item->getPostMatchInfo());
        $matchInfosDoctrine->setHomeTeamInfo($item->getHomeTeamInfo());
        $matchInfosDoctrine->setAwayTeamInfo($item->getAwayTeamInfo());

        return $matchInfosDoctrine;
    }
}
