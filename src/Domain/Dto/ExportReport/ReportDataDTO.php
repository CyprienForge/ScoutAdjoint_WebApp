<?php

namespace Domain\Dto\ExportReport;

use Domain\Entity\MatchInfos;

class ReportDataDTO
{

    public function __construct(
        public array $homePlayers,
        public array $awayPlayers,
        public array $homeSubstitutes,
        public array $awaySubstitutes,
        public string $homeTeamName,
        public string $awayTeamName,
        public string $dateMatch,
        public string $stadiumName,
        public string $competitionName,
        public MatchInfos $matchInfos
    ){}

}
