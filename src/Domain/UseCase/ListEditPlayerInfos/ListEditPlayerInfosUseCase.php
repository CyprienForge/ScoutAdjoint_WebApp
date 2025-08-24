<?php

namespace Domain\UseCase\ListEditPlayerInfos;

use Domain\Mapper\PositionMapper;
use Domain\Mapper\TeamMapper;
use Domain\Repository\PlacementRepository;
use Domain\Repository\PositionRepository;
use Domain\Repository\TeamRepository;
use Domain\Request\ListEditPlayerInfos\ListEditPlayerInfosRequest;
use Domain\Response\ListEditPlayerInfos\ListEditPlayerInfosResponse;

class ListEditPlayerInfosUseCase
{

    public function __construct(
        private PositionRepository $positionRepository,
        private PositionMapper $positionMapper,
        private PlacementRepository $placementRepository,
        private TeamRepository $teamRepository,
        private TeamMapper $teamMapper
    ){}

    public function execute(ListEditPlayerInfosRequest $request) : ListEditPlayerInfosResponse
    {
        $allPositionsInfra = $this->positionRepository->findAll();
        $allPositions = array_map(fn($pos) => $this->positionMapper->toDomain($pos), $allPositionsInfra);

        $placementsInfra = array_filter($this->placementRepository->findByPlayer($request->playerId));
        $positions = array_map(fn($placement) => $this->positionMapper->toDomain($placement->getPosition()), $placementsInfra);

        $teamsInfra = array_filter($this->teamRepository->findAll());
        $teams = array_map(fn($team) => $this->teamMapper->toDomain($team), $teamsInfra);

        $listEditInfosResponse = new ListEditPlayerInfosResponse(
            $allPositions,
            $positions,
            $teams,
        );
        return $listEditInfosResponse;
    }

}
