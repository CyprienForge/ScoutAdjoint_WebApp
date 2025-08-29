<?php

namespace Domain\ViewModel\EditGlobalInfosMatch;

class EditGlobalInfosMatchViewModel
{
    public function __construct(
        public int $idMatch,
        public string $homeTeamName,
        public string $awayTeamName,
        public string $homeTeamId,
        public string $awayTeamId,
        public string $homeTeamSelected,
        public string $awayTeamSelected
    ){}
}
