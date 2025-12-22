<?php

namespace Application\Query\FetchPlayers;

use Domain\Presenter\FetchPlayers\FetchPlayersPresenter;
use Domain\Repository\Placement\PlacementReadRepository;
use Domain\Repository\Player\PlayerReadRepository;
use Domain\Request\FetchPlayers\FetchPlayersRequest;
use Domain\Response\FetchPlayers\FetchPlayersResponse;

class FetchPlayersQuery
{

    public function __construct(
        private PlayerReadRepository  $playerRepository,
        private FetchPlayersPresenter $presenter,
        private PlacementReadRepository $placementReadRepository,
    ){}

    public function execute(FetchPlayersRequest $request) : FetchPlayersResponse
    {
        $positions = [];
        $players = $this->playerRepository->findPaginated(
            $request->limit,
            $request->offset,
            $request->firstNameSearch,
            $request->lastNameSearch,
            $request->startBirthDate,
            $request->endBirthDate,
            $request->isOr,
            $request->positions,
            $request->team
        );

        foreach ($players as $player) {
            $positions[] = $this->placementReadRepository->findByPlayer($player->getId());
        }

        $response = new FetchPlayersResponse($players, $request->pageNumber, $request->limit, $positions);
        $this->presenter->present($response);

        return $response;
    }

}
