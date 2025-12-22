<?php

namespace Domain\Response\FetchPositionsByPlayer;

class FetchPositionsByPlayerResponse
{

    public function __construct(
        public array $positions
    ){}

}
