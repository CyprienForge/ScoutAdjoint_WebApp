<?php

namespace Application\Query\FetchTeams;

use Domain\Mapper\TeamMapper;
use Domain\Repository\Team\TeamReadRepository;
use Domain\Request\FetchTeams\FetchTeamsRequest;
use Domain\Response\FetchTeams\FetchTeamsResponse;

class FetchTeamsQuery
{
    public function __construct(
        private TeamReadRepository $teamRepository,
        private FetchTeamsOutputBoundary $presenter
    ){}

    public function execute(FetchTeamsRequest $request) : FetchTeamsResponse
    {
        $teams = $this->teamRepository->findAll();
        $response = new FetchTeamsResponse($teams);
        $this->presenter->present($response);

        return $response;
    }
}
