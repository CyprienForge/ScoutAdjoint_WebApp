<?php

namespace Application\Query\ListMatchInfos;

use Domain\Exception\NotFoundException;
use Domain\Mapper\MatchInfosMapper;
use Domain\Presenter\ListMatchInfos\ListMatchInfosPresenter;
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
        try{
            $matchInfos = $this->matchInfosRepository->findByMatch($request->idMatch);
        }catch (NotFoundException $e){
            throw $e;
        }
        return new ListMatchInfosResponse($matchInfos);
    }
}
