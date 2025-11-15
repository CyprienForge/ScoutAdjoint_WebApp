<?php

namespace Domain\Presenter\FetchPlayers;

use Domain\Response\FetchPlayers\FetchPlayersResponse;

interface FetchPlayersPresenter
{
    public function present(FetchPlayersResponse $response) : void;

    public function getPresentation();
}
