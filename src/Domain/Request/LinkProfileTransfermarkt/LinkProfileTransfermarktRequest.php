<?php

namespace Domain\Request\LinkProfileTransfermarkt;

class LinkProfileTransfermarktRequest
{
    public function __construct(
        public int $idPlayer
    ){}
}
