<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\Player\Player;
use Domain\Entity\Player\ValueObject\GeneralNote;
use Domain\Entity\Player\ValueObject\PlayerBirthDate;
use Domain\Entity\Player\ValueObject\PlayerId;
use Domain\Entity\Player\ValueObject\PlayerName;
use Domain\Entity\Player\ValueObject\TransfermarktUrl;
use Domain\Mapper\PlayerMapper;
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
        $id = $item->getId();
        $firstName = $item->getFirstName();
        $lastName = $item->getLastName();
        $birthDate = $item->getBirthDate();
        $generalNote = $item->getGeneralNote();

        $team = null;
        if($item->getTeam() !== null) {
            $team = $this->teamMapperDoctrine->toDomain($item->getTeam());
        }
        $transfermarktUrl = $item->getTransfermarktUrl();

        $player = new Player(
            new PlayerId($id),
            new PlayerName($firstName, $lastName),
            new PlayerBirthDate($birthDate),
            $team,
            new TransfermarktUrl($transfermarktUrl),
            new GeneralNote($generalNote)
        );
        return $player;
    }

    public function toInfra($item, ?PlayerDoctrine $existing = null): PlayerDoctrine
    {
        $playerDoctrine = $existing ?? new PlayerDoctrine();

        $playerDoctrine->setId($item->getId()->value());
        $playerDoctrine->setFirstName($item->getName()->firstName());
        $playerDoctrine->setLastName($item->getName()->lastName());
        $playerDoctrine->setBirthDate($item->getBirthDate()->value());
        $playerDoctrine->setTransfermarktUrl($item->getTransfermarktUrl()->value());
        $playerDoctrine->setGeneralNote($item->getGeneralNote()->value());

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
