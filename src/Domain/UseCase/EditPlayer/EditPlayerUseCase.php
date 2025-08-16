<?php

namespace Domain\UseCase\EditPlayer;

use Domain\Exception\DomainException;
use Domain\Exception\EditPlayer\BadMimeTypeImageException;
use Domain\Exception\EditPlayer\BadSizeImageException;
use Domain\Mapper\PlayerMapper;
use Domain\Repository\PlayerRepository;
use Domain\Request\EditPlayer\EditPlayerRequest;
use Domain\Validator\EditPlayer\ImageValidator;
use Exception;

class EditPlayerUseCase
{

    public function __construct(
        private PlayerRepository $playerRepository,
        private PlayerMapper $playerMapper
    ){}

    public function execute(EditPlayerRequest $request)
    {
        $playerInfra = $this->playerRepository->findById($request->idPlayer);
        $player = $this->playerMapper->toDomain($playerInfra);

        $player->setFirstName($request->newFirstName);
        $player->setLastName($request->newLastName);
        $player->setBirthDate($request->newBirthDate);
        $player->setTeam($request->newTeam);

        try{
            //ImageValidator::validSize($request->newImage->getSize());
            //ImageValidator::validMimeType($request->newImage->getMimeType());
        }catch(BadSizeImageException $e) {

        }catch(BadMimeTypeImageException $e) {

        }

        $player = $this->playerMapper->toInfra($player, $playerInfra);
        $this->playerRepository->save($player);
    }

}
