<?php

namespace Domain\Presenter\FetchTeams;

use Domain\Request\FetchTeams\FetchTeamsRequest;
use Domain\Response\FetchPositionsByPlayer\FetchPositionsByPlayerResponse;
use Domain\Response\FetchTeams\FetchTeamsResponse;

interface FetchTeamsPresenter
{
    public function present(FetchTeamsResponse $response) : void;

    public function getPresentation();
}
