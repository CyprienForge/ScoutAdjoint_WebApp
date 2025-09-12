<?php

namespace Application\Query\FetchPlayers;

use Domain\Mapper\PlayerMapper;
use Domain\Repository\PlayerRepository;
use Domain\Request\FetchPlayers\FetchPlayersRequest;
use Domain\Response\FetchPlayers\FetchPlayersResponse;

class FetchPlayersQuery
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
            $request->endBirthDate,
            $request->positions,
            $request->team
        );
        foreach($playersResponse as $playerResponse){
            $players[] = $this->playerMapper->toDomain($playerResponse);
        }

        $response = new FetchPlayersResponse($players, $request->pageNumber, $request->limit);
        $this->presenter->present($response);

        return $response;
    }

}
