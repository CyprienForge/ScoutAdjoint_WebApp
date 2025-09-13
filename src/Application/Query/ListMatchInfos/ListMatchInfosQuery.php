<?php

namespace Application\Query\ListMatchInfos;

use Domain\Mapper\MatchInfosMapper;
use Domain\Repository\MatchInfos\MatchInfosReadRepository;
use Domain\Request\ListMatchInfos\ListMatchInfosRequest;
use Domain\Response\ListMatchInfos\ListMatchInfosResponse;

class ListMatchInfosQuery
{
    public function __construct(
        private MatchInfosReadRepository $matchInfosRepository,
        private MatchInfosMapper $matchInfosMapper
    ){}

    public function execute(ListMatchInfosRequest $request): ListMatchInfosResponse
    {
        $matchInfosInfra = $this->matchInfosRepository->findByMatch($request->idMatch);
        return new ListMatchInfosResponse($this->matchInfosMapper->toDomain($matchInfosInfra));
    }
}
