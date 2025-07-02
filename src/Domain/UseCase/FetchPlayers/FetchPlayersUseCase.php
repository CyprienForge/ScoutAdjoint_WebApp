<?php

namespace Domain\UseCase\FetchPlayers;

use Domain\Factory\PlayerFactory;
use Domain\Mapper\PlayerMapper;
use Domain\Repository\PlayerRepository;
use Domain\Repository\TeamRepository;
use Domain\Request\FetchPlayers\FetchPlayersRequest;
use Domain\Response\FetchPlayers\FetchPlayersResponse;
use Infrastructure\Entity\Doctrine\Mapper\PlayerMapperDoctrine;

class FetchPlayersUseCase
{

    public function __construct(
      private PlayerRepository $playerRepository,
      private FetchPlayersOutputBoundary $presenter,
        private PlayerMapper $playerMapper,
    ){}

    public function execute(FetchPlayersRequest $request) : FetchPlayersResponse
    {
        $players = [];

        $playersResponse = $this->playerRepository->findPaginated(
            $request->limit,
            $request->offset,
            $request->firstNameSearch,
            $request->lastNameSearch,
            $request->startBirthDate,
            $request->endBirthDate
        );
        foreach($playersResponse as $playerResponse){
            $players[] = $this->playerMapper->toDomain($playerResponse);
        }

        $response = new FetchPlayersResponse($players, $request->pageNumber, $request->limit);
        $this->presenter->present($response);

        return $response;
    }

}
