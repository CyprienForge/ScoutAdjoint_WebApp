<?php

namespace Domain\ViewModel\Entity;

class MatchViewModel
{
    public function __construct(
        public int $id,
        public string $date,
        public int $scoreHome,
        public int $scoreAway,
        public string $homeTeamName,
        public string $awayTeamName,
    ){}
}
