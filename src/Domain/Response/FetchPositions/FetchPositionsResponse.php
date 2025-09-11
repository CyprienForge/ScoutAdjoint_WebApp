<?php

namespace Domain\Response\FetchPositions;

class FetchPositionsResponse
{

    public function __construct(
        public array $positions,
    ){}

}
