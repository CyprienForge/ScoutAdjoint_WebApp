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
        private TeamMapper $teamMapper,
        private FetchTeamsOutputBoundary $presenter
    ){}

    public function execute(FetchTeamsRequest $request) : FetchTeamsResponse
    {
        $teamsInfra = $this->teamRepository->findAll();
        $teams = [];

        foreach($teamsInfra as $team){
            $teams[] = $this->teamMapper->toDomain($team);
        }

        $response = new FetchTeamsResponse($teams);
        $this->presenter->present($response);

        return $response;
    }
}
