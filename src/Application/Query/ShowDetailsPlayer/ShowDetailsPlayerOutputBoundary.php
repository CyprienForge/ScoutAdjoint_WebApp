<?php

namespace Application\Query\ShowDetailsPlayer;

use Domain\Response\ShowDetailsPlayer\ShowDetailsPlayerResponse;

interface ShowDetailsPlayerOutputBoundary
{
    public function present(ShowDetailsPlayerResponse $response) : void;
    public function getViewModel();
}
