<?php

namespace Domain\Response\ShowDetailsPlayer;

use Domain\Entity\Player;

class ShowDetailsPlayerResponse
{
    public function __construct(
        public Player $player,
        public array $participations
    ){}
}
