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
    ){}
    public function execute(FetchPositionsRequest $request): FetchPositionsResponse
    {
        $positions = $this->positionRepository->findAll();
        return new FetchPositionsResponse($positions);
    }

}
