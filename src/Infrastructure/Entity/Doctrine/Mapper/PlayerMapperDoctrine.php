<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Player;
use Domain\Mapper\Mapper;
use Domain\Mapper\PlayerMapper;
use Domain\Repository\PlayerRepository;
use Domain\Repository\TeamRepository;
use Infrastructure\Entity\Doctrine\PlayerDoctrine;

class PlayerMapperDoctrine implements PlayerMapper
{
    public function __construct(
        private TeamMapperDoctrine $teamMapperDoctrine,
        private TeamRepository $teamRepository,
        private PlayerRepository $playerRepository,
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

    public function toInfra($item)
    {
        $playerDoctrine = null;

        if ($item->getId()) {
            $playerDoctrine = $this->playerRepository->findById($item->getId());
        }

        if (!$playerDoctrine) {
            $playerDoctrine = new PlayerDoctrine();
        }

        $playerDoctrine->setId($item->getId());
        $playerDoctrine->setFirstName($item->getFirstName());
        $playerDoctrine->setLastName($item->getLastName());
        $playerDoctrine->setBirthDate($item->getBirthDate());

        $teamDoctrine = null;
        if ($item->getTeam() !== null && $item->getTeam()->getId() !== null) {
            $teamDoctrine = $this->teamRepository->findById($item->getTeam()->getId());
        }
        $playerDoctrine->setTeam($teamDoctrine);
        $playerDoctrine->setTransfermarktUrl($item->getTransfermarktUrl());

        return $playerDoctrine;
    }

}
