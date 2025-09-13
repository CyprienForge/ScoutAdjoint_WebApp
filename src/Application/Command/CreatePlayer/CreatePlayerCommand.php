<?php

namespace Application\Command\CreatePlayer;

use Domain\Entity\Placement;
use Domain\Entity\Player;
use Domain\Mapper\PlacementMapper;
use Domain\Mapper\PlayerMapper;
use Domain\Repository\Placement\PlacementRepository;
use Domain\Repository\Placement\PlacementWriteRepository;
use Domain\Repository\Player\PlayerRepository;
use Domain\Repository\Player\PlayerWriteRepository;
use Domain\Request\CreatePlayer\CreatePlayerRequest;
use Domain\Response\CreatePlayer\CreatePlayerResponse;

class CreatePlayerCommand
{

    public function __construct(
        private PlayerMapper $playerMapper,
        private PlayerWriteRepository $playerRepository,
        private PlacementMapper $placementMapper,
        private PlacementWriteRepository $placementRepository
    ){}

    public function execute(CreatePlayerRequest $request) : CreatePlayerResponse
    {
        $createPlayerDTO = $request->createPlayerDTO;

        $player = new Player();
        $player->setId(0)
                ->setFirstName($createPlayerDTO->firstName)
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
