<?php

namespace Domain\UseCase\FetchPlayers;

use Domain\Factory\PlayerFactory;
use Domain\Repository\PlayerRepository;
use Domain\Repository\TeamRepository;
use Domain\Request\FetchPlayers\FetchPlayersRequest;
use Domain\Response\FetchPlayers\FetchPlayersResponse;

class FetchPlayersUseCase
{

    public function __construct(
      private PlayerRepository $playerRepository,
      private TeamRepository $teamRepository,
      private FetchPlayersOutputBoundary $presenter
    ){}

    public function execute(FetchPlayersRequest $request) : FetchPlayersResponse
    {
        $players = [];

        $playersResponse = $this->playerRepository->findAll();
        foreach($playersResponse as $playerResponse){
            $team = $this->teamRepository->findById($playerResponse['team']);
            $playerResponse['team'] = $team;
            $players[] = PlayerFactory::build($playerResponse);
        }

        $response = new FetchPlayersResponse($players);
        $this->presenter->present($response);

        return $response;
    }

}
