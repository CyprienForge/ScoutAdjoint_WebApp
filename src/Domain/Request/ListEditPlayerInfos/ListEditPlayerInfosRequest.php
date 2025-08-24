<?php

namespace Domain\Request\ListEditPlayerInfos;

class ListEditPlayerInfosRequest
{

    public function __construct(
        public int $playerId
    ){}

}
