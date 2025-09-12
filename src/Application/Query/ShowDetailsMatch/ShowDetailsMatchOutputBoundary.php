<?php

namespace Application\Query\ShowDetailsMatch;

use Domain\Response\ShowDetailsMatch\ShowDetailsMatchResponse;

interface ShowDetailsMatchOutputBoundary
{
    public function present(ShowDetailsMatchResponse $response);

    public function getViewModel();
}
