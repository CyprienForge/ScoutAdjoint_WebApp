<?php

namespace Application\Query\FetchMatchs;

use Domain\Mapper\MatchMapper;
use Domain\Repository\Match\MatchReadRepository;
use Domain\Request\FetchMatchs\FetchMatchsRequest;
use Domain\Response\FetchMatchs\FetchMatchsResponse;

class FetchMatchsQuery
{

    public function __construct(
        private MatchReadRepository $matchRepository,
        private MatchMapper $matchMapper,
        private FetchMatchsOutputBoundary $presenter,
    ){}

    public function execute(FetchMatchsRequest $request) : FetchMatchsResponse
    {
        $matchs = [];
        $matchsInfra = $this->matchRepository->findAll();

        foreach($matchsInfra as $match){
            $matchs[] = $this->matchMapper->toDomain($match);
        }

        $response = new FetchMatchsResponse($matchs);
        $this->presenter->present($response);

        return $response;
    }

}
