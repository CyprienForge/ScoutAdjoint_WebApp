<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Player;
use Domain\Mapper\PlayerMapper;
use Domain\Repository\Player\PlayerReadRepository;
use Domain\Repository\Team\TeamReadRepository;
use Infrastructure\Entity\Doctrine\PlayerDoctrine;

class PlayerMapperDoctrine implements PlayerMapper
{
    public function __construct(
        private TeamMapperDoctrine $teamMapperDoctrine,
        private TeamReadRepository $teamRepository,
    ) {}

    public function toDomain($item)
    {
        $player = new Player();
        $player->setId($item->getId() ?? 0);
        $player->setFirstName($item->getFirstName());
        $player->setLastName($item->getLastName());
        $player->setBirthDate($item->getBirthDate());

        $team = $this->teamMapperDoctrine->toDomain($item->getTeam());

        $player->setTeam($team);
        $player->setTransfermarktUrl($item->getTransfermarktUrl());

        return $player;
    }

    public function toInfra($item, ?PlayerDoctrine $existing = null): PlayerDoctrine
    {
        $playerDoctrine = $existing ?? new PlayerDoctrine();

        $playerDoctrine->setId($item->getId());
        $playerDoctrine->setFirstName($item->getFirstName());
        $playerDoctrine->setLastName($item->getLastName());
        $playerDoctrine->setBirthDate($item->getBirthDate());
        $playerDoctrine->setTransfermarktUrl($item->getTransfermarktUrl());

        if ($item->getTeam() !== null && $item->getTeam()->getId() !== null) {
            $teamDoctrine = $this->teamRepository->find($item->getTeam()->getId());
            if (!$teamDoctrine) {
                $teamDoctrine = $this->teamMapperDoctrine->toInfra($item->getTeam());
            }

            $playerDoctrine->setTeam($teamDoctrine);
        }

        return $playerDoctrine;
    }

}
