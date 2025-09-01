<?php

namespace Domain\UseCase\FetchTeams;

use Domain\Mapper\TeamMapper;
use Domain\Repository\TeamRepository;
use Domain\Request\FetchTeams\FetchTeamsRequest;
use Domain\Response\FetchTeams\FetchTeamsResponse;

class FetchTeamsUseCase
{
    public function __construct(
        private TeamRepository $teamRepository,
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
