<?php

namespace Application\Command\CreatePlayer;

use Domain\Entity\Placement;
use Domain\Entity\Player;
use Domain\Repository\Placement\PlacementWriteRepository;
use Domain\Repository\Player\PlayerReadRepository;
use Domain\Repository\Player\PlayerWriteRepository;
use Domain\Repository\Position\PositionReadRepository;
use Domain\Repository\Team\TeamReadRepository;
use Domain\Request\CreatePlayer\CreatePlayerRequest;
use Domain\Response\CreatePlayer\CreatePlayerResponse;

class CreatePlayerCommand
{

    public function __construct(
        private PlayerReadRepository $playerReadRepository,
        private TeamReadRepository $teamReadRepository,
        private PositionReadRepository $positionReadRepository,
        private PlayerWriteRepository $playerRepository,
        private PlacementWriteRepository $placementRepository
    ){}

    public function execute(CreatePlayerRequest $request) : CreatePlayerResponse
    {
        $player = new Player();
        $createPlayerDTO = $request->createPlayerDTO;
        if($createPlayerDTO->idTeam != null){
            $team = $this->teamReadRepository->findById($createPlayerDTO->idTeam);
            $player->setTeam($team);
        }

        $player->setId(0)
                ->setFirstName($createPlayerDTO->firstName)
                ->setLastName($createPlayerDTO->lastName)
                ->setBirthDate($createPlayerDTO->birthDate);

        $this->playerRepository->save($player);
        $player = $this->playerReadRepository->findById($this->playerRepository->getLastInsertId());

        foreach($createPlayerDTO->positions as $position){
            $placement = new Placement();
            $position = $this->positionReadRepository->findById($position);
            $placement->setPosition($position)->setPlayer($player);
            $this->placementRepository->save($placement);
        }

        return new CreatePlayerResponse($player);
    }

}
