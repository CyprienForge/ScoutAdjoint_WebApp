<?php

namespace Domain\Response\FetchPlayers;

class FetchPlayersResponse
{
    public function __construct(
        private array $players,
        private string $pageNumber,
        private int $limit
    ){}

    public function getPlayers() : array
    {
        return $this->players;
    }

    public function getLimit() : int
    {
        return $this->limit;
    }

    public function getPageNumber() : string
    {
        return $this->pageNumber;
    }
}
