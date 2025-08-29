<?php

namespace Domain\UseCase\ListMatchInfos;

use Domain\Mapper\MatchInfosMapper;
use Domain\Repository\MatchInfosRepository;
use Domain\Request\ListMatchInfos\ListMatchInfosRequest;
use Domain\Response\ListMatchInfos\ListMatchInfosResponse;

class ListMatchInfosUseCase
{
    public function __construct(
        private MatchInfosRepository $matchInfosRepository,
        private MatchInfosMapper $matchInfosMapper
    ){}

    public function execute(ListMatchInfosRequest $request): ListMatchInfosResponse
    {
        $matchInfosInfra = $this->matchInfosRepository->findByMatch($request->idMatch);
        return new ListMatchInfosResponse($this->matchInfosMapper->toDomain($matchInfosInfra));
    }
}
