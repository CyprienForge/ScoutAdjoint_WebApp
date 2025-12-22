<?php

namespace Application\Query\FetchPositionsByPlayer;

use Domain\Presenter\FetchPositionsByPlayer\FetchPositionsByPlayerPresenter;
use Domain\Repository\Placement\PlacementReadRepository;
use Domain\Repository\Position\PositionReadRepository;
use Domain\Request\FetchPositionsByPlayer\FetchPositionsByPlayerRequest;
use Domain\Response\FetchPositionsByPlayer\FetchPositionsByPlayerResponse;

class FetchPositionsByPlayerUseCase
{
    public function __construct(
        private PlacementReadRepository $positionRepository,
        private FetchPositionsByPlayerPresenter $presenter
    ){}

    public function execute(FetchPositionsByPlayerRequest $request): FetchPositionsByPlayerResponse
    {
        $positions = $this->positionRepository->findByPlayer($request->idPlayer);
        $response = new FetchPositionsByPlayerResponse($positions);
        $this->presenter->present($response);

        return $response;
    }

}
