<?php

namespace Domain\Response\FetchMatchs;

class FetchMatchsResponse
{
    public function __construct(
        private array $matchs
    ){}
    public function getMatchs(): array
    {
        return $this->matchs;
    }
}
