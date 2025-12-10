<?php

namespace Domain\Request\ShowDetailsPlayer;

class ShowDetailsPlayerRequest
{
    public function __construct(
        public int $idPlayer,
    ){}

}
