<?php

namespace Domain\Response\ListEditPlayerInfos;

class ListEditPlayerInfosResponse
{

    public function __construct(
        public array $allPositions,
        public array $positionsSelected,
        public array $teams
    ){}

}
