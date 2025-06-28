<?php

namespace Domain\ViewModel\FetchPlayers;

use Domain\Response\FetchPlayers\FetchPlayersResponse;

class FetchPlayersViewModel
{
    public array $playerViewModels = [];

    public int $pageNumber;

    public int $previousPageNumber;
    public int $nextPageNumber;

    public function getPlayerViewModels(): array
    {
        return $this->playerViewModels;
    }
}
