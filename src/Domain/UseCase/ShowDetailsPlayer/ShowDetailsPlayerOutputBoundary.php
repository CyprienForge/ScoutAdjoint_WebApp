<?php

namespace Domain\UseCase\ShowDetailsPlayer;

use Domain\Response\ShowDetailsPlayer\ShowDetailsPlayerResponse;

interface ShowDetailsPlayerOutputBoundary
{
    public function present(ShowDetailsPlayerResponse $response) : void;
    public function getViewModel();
}
