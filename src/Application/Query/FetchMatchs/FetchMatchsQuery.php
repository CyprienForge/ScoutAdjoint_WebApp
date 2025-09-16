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
        private FetchMatchsOutputBoundary $presenter,
    ){}

    public function execute(FetchMatchsRequest $request) : FetchMatchsResponse
    {
        $matchs = $this->matchRepository->findAll();

        $response = new FetchMatchsResponse($matchs);
        $this->presenter->present($response);

        return $response;
    }

}
