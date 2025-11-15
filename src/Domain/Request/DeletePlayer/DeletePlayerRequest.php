<?php

namespace Domain\Request\DeletePlayer;

class DeletePlayerRequest
{

    public function __construct(
        public int $idPlayer
    ){}

}
