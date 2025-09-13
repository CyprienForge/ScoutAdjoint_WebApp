<?php

namespace Application\Query\FetchPositions;

use Domain\Mapper\PositionMapper;
use Domain\Repository\Position\PositionReadRepository;
use Domain\Request\FetchPositions\FetchPositionsRequest;
use Domain\Response\FetchPositions\FetchPositionsResponse;

class FetchPositionsQuery
{
    public function __construct(
        private PositionReadRepository $positionRepository,
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
