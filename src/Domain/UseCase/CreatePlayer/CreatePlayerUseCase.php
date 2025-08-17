<?php

namespace Domain\UseCase\CreatePlayer;

use Domain\Entity\Placement;
use Domain\Entity\Player;
use Domain\Mapper\PlacementMapper;
use Domain\Mapper\PlayerMapper;
use Domain\Mapper\PositionMapper;
use Domain\Repository\PlacementRepository;
use Domain\Repository\PlayerRepository;
use Domain\Request\CreatePlayer\CreatePlayerRequest;
use Domain\Response\CreatePlayer\CreatePlayerResponse;

class CreatePlayerUseCase
{

    public function __construct(
        private PlayerMapper $playerMapper,
        private PlayerRepository $playerRepository,
        private PlacementMapper $placementMapper,
        private PlacementRepository $placementRepository
    ){}

    public function execute(CreatePlayerRequest $request) : CreatePlayerResponse
    {
        $createPlayerDTO = $request->createPlayerDTO;

        $player = new Player();
        $player->setFirstName($createPlayerDTO->firstName)
                ->setLastName($createPlayerDTO->lastName)
                ->setBirthDate($createPlayerDTO->birthDate)
                ->setTeam($createPlayerDTO->team);

        $playerInfra = $this->playerMapper->toInfra($player);
        $this->playerRepository->save($playerInfra);
        $player = $this->playerMapper->toDomain($playerInfra);

        foreach($createPlayerDTO->positions as $position){
            $placement = new Placement();

            $placement->setPosition($position)->setPlayer($player);
            $placementInfra = $this->placementMapper->toInfra($placement);

            $this->placementRepository->save($placementInfra);
        }

        return new CreatePlayerResponse();
    }

}
