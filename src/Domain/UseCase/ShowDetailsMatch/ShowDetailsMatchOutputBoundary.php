<?php

namespace Domain\UseCase\ShowDetailsMatch;

use Domain\Response\ShowDetailsMatch\ShowDetailsMatchResponse;

interface ShowDetailsMatchOutputBoundary
{
    public function present(ShowDetailsMatchResponse $response);

    public function getViewModel();
}
