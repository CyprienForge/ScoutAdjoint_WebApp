<?php

namespace Domain\UseCase\ShowDetailsMatch;

use Domain\Repository\MatchRepository;
use Domain\Repository\ParticipationRepository;
use Domain\Request\ShowDetailsMatch\ShowDetailsMatchRequest;
use Domain\Response\ShowDetailsMatch\ShowDetailsMatchResponse;
use Domain\Response\ShowDetailsPlayer\ShowDetailsPlayerResponse;

class ShowDetailsMatchUseCase
{

    public function __construct(
        private MatchRepository $matchRepository,
        private ParticipationRepository $participationRepository,
    ){}

    public function execute(ShowDetailsMatchRequest $request) : ShowDetailsMatchResponse
    {

        $response = new ShowDetailsMatchResponse();
        return $response;
    }
}
