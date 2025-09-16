<?php

namespace Application\Query\ListEditPlayerInfos;

use Domain\Mapper\PositionMapper;
use Domain\Mapper\TeamMapper;
use Domain\Repository\Placement\PlacementReadRepository;
use Domain\Repository\Position\PositionReadRepository;
use Domain\Repository\Team\TeamReadRepository;
use Domain\Request\ListEditPlayerInfos\ListEditPlayerInfosRequest;
use Domain\Response\ListEditPlayerInfos\ListEditPlayerInfosResponse;

class ListEditPlayerInfosQuery
{

    public function __construct(
        private PositionReadRepository $positionRepository,
        private PlacementReadRepository $placementRepository,
        private TeamReadRepository $teamRepository,
    ){}

    public function execute(ListEditPlayerInfosRequest $request) : ListEditPlayerInfosResponse
    {
        $allPositions = $this->positionRepository->findAll();
        $positionsSelected = $this->placementRepository->findByPlayer($request->playerId);

        $teams = $this->teamRepository->findAll();

        $listEditInfosResponse = new ListEditPlayerInfosResponse(
            $allPositions,
            $positionsSelected,
            $teams,
        );
        return $listEditInfosResponse;
    }

}
