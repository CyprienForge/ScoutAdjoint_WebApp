<?php

namespace Domain\Request\CreatePlayer;

use Domain\Dto\CreatePlayer\CreatePlayerDTO;

class CreatePlayerRequest
{

    public function __construct(
        public CreatePlayerDTO $createPlayerDTO
    ){}

}
