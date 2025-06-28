<?php

namespace Domain\UseCase\FetchPlayers;

use Domain\Response\FetchPlayers\FetchPlayersResponse;

interface FetchPlayersOutputBoundary
{
    public function present(FetchPlayersResponse $response) : void;

    public function getViewModel();
}
