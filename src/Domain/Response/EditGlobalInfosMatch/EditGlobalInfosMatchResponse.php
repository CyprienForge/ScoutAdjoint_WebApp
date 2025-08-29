<?php

namespace Domain\Response\EditGlobalInfosMatch;

use Domain\Entity\MatchGame;
use Domain\Entity\Team;

class EditGlobalInfosMatchResponse
{
    public function __construct(
        public MatchGame $match,
    ){}
}
