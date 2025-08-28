<?php

namespace Domain\Dto\ExportReport;

class ReportDataDTO
{

    public function __construct(
        public array $homePlayers,
        public array $awayPlayers,
        public array $homeSubstitutes,
        public array $awaySubstitutes,
        public string $homeTeamName,
        public string $awayTeamName,
    ){}

}
