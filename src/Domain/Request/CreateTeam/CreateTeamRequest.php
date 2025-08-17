<?php

namespace Domain\Request\CreateTeam;

use Domain\Entity\Team;

class CreateTeamRequest
{

    public function __construct(
        public Team $team,
    ){}

}
