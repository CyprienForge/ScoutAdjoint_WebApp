<?php

namespace Domain\ViewModel\Entity;

class ParticipationViewModel
{
    public function __construct(
        public int $indexLoop,
        public string $date,
        public string $location,
        public string $teamName,
        public string $teamOpponentName,
        public int $numero
    ){}
}
