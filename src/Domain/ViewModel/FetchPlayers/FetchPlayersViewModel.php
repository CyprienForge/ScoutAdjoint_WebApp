<?php

namespace Domain\ViewModel\FetchPlayers;

use Domain\Response\FetchPlayers\FetchPlayersResponse;

class FetchPlayersViewModel
{
    public function __construct(
        public string $fullName,
        public string $teamName
    ){}
}
