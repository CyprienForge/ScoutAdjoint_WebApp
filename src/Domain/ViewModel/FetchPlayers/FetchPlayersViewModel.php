<?php

namespace Domain\ViewModel\FetchPlayers;

use Domain\Response\FetchPlayers\FetchPlayersResponse;

class FetchPlayersViewModel
{
    public function __construct(
        public int $positionLoop,
        public string $firstName,
        public string $lastName,
        public string $teamName,
        public string $birthDate,
    ){}

}
