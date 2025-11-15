<?php

namespace Domain\Response\ShowMerge;

use Domain\Entity\Player;

class ShowMergeResponse
{

    public function __construct(
        public Player $playerToMerge,
    ){}

}
