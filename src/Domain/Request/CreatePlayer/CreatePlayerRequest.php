<?php

namespace Domain\Request\CreatePlayer;

use Domain\Dto\CreatePlayer\CreatePlayerDTO;
use Domain\Entity\Player;

class CreatePlayerRequest
{

    public function __construct(
        public CreatePlayerDTO $createPlayerDTO
    ){}

}
