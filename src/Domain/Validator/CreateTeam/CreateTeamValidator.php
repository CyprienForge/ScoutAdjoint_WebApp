<?php

namespace Domain\Validator\CreateTeam;

use Domain\Entity\Team;
use Domain\Exception\CreateTeam\CreateTeamException;

class CreateTeamValidator
{

    public function validate(Team $team)
    {
        if($team->getName() == "" || $team->getName() == null){
            throw new CreateTeamException('Team name is required');
        }
    }

}
