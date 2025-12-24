<?php

namespace Domain\Response\CreatePlayer;

use Domain\Entity\Player\Player;

class CreatePlayerResponse
{
    public function __construct(
        public Player $playerCreated
    ){}
}
