<?php

namespace Domain\UseCase\FetchTeams;

use Domain\Response\FetchTeams\FetchTeamsResponse;

interface FetchTeamsOutputBoundary
{
    public function present(FetchTeamsResponse $response);
}
