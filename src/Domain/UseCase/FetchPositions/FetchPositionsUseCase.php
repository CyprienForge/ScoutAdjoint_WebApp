<?php

namespace Domain\UseCase\FetchPositions;

use Domain\Mapper\PositionMapper;
use Domain\Repository\PositionRepository;
use Domain\Request\FetchPositions\FetchPositionsRequest;
use Domain\Response\FetchPositions\FetchPositionsResponse;

class FetchPositionsUseCase
{
    public function __construct(
        private PositionRepository $positionRepository,
        private PositionMapper $positionMapper,
    ){}
    public function execute(FetchPositionsRequest $request): FetchPositionsResponse
    {
        $positionsInfra = $this->positionRepository->findAll();
        $positions = [];

        foreach($positionsInfra as $position){
            $positions[] = $this->positionMapper->toDomain($position);
        }

        return new FetchPositionsResponse($positions);
    }

}
