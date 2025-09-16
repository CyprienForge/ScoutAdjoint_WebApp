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
    ){}

    public function execute(ListMatchInfosRequest $request): ListMatchInfosResponse
    {
        $matchInfos = $this->matchInfosRepository->findByMatch($request->idMatch);
        return new ListMatchInfosResponse($matchInfos);
    }
}
