<?php

namespace Domain\UseCase\FetchMatchs;

use Domain\Mapper\MatchMapper;
use Domain\Repository\MatchRepository;
use Domain\Request\FetchMatchs\FetchMatchsRequest;
use Domain\Response\FetchMatchs\FetchMatchsResponse;

class FetchMatchsUseCase
{

    public function __construct(
        private MatchRepository $matchRepository,
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
