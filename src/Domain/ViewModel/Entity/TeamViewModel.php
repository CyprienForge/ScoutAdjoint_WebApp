<?php

namespace Domain\ViewModel\Entity;

use Domain\Entity\Team;

class TeamViewModel
{
    public function __construct(
        public string $name
    ){}
}
