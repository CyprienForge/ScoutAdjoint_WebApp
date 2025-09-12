<?php

namespace Domain\Request\MergePlayers;

class MergePlayersRequest
{

    public function __construct(
        public int $idPlayerToMerge,
    ){}

}
