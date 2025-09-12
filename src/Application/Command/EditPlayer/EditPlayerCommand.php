<?php

namespace Application\Command\EditPlayer;

use Domain\Entity\Placement;
use Domain\Mapper\PlacementMapper;
use Domain\Mapper\PlayerMapper;
use Domain\Repository\PlacementRepository;
use Domain\Repository\PlayerRepository;
use Domain\Request\EditPlayer\EditPlayerRequest;

class EditPlayerCommand
{

    public function __construct(
        private PlayerRepository $playerRepository,
        private PlayerMapper $playerMapper,
        private PlacementMapper $placementMapper,
        private PlacementRepository $placementRepository,
    ){}

    public function execute(EditPlayerRequest $request)
    {
        $playerInfra = $this->playerRepository->findById($request->editPlayerDTO->idPlayer);
        $player = $this->playerMapper->toDomain($playerInfra);

        $player->setFirstName($request->editPlayerDTO->newFirstName);
        $player->setLastName($request->editPlayerDTO->newLastName);
        $player->setBirthDate($request->editPlayerDTO->newBirthDate);
        $player->setTeam($request->editPlayerDTO->newTeam);

        /*
        try{
            //ImageValidator::validSize($request->newImage->getSize());
            //ImageValidator::validMimeType($request->newImage->getMimeType());
        }catch(BadSizeImageException $e) {

        }catch(BadMimeTypeImageException $e) {

        }
        */
        $this->placementRepository->deleteAllByPlayer($player->getId());
        foreach($request->editPlayerDTO->getNewPositions() as $position)
        {
            $placement = new Placement();
            $placement->setPosition($position);
            $placement->setPlayer($player);

            $placementInfra = $this->placementMapper->toInfra($placement);
            $this->placementRepository->save($placementInfra);
        }

        $player = $this->playerMapper->toInfra($player, $playerInfra);
        $this->playerRepository->save($player);
    }

}
