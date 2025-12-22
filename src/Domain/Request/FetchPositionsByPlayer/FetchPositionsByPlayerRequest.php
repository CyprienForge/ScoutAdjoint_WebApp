<?php

namespace Domain\Request\FetchPositionsByPlayer;

class FetchPositionsByPlayerRequest
{

    public function __construct(
        public int $idPlayer
    ){}

}
