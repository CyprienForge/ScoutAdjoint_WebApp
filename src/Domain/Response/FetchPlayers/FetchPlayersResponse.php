<?php

namespace Domain\Response\FetchPlayers;

class FetchPlayersResponse
{
    public function __construct(
        private array $players
    ){}

    public function getPlayers() : array
    {
        return $this->players;
    }
}
