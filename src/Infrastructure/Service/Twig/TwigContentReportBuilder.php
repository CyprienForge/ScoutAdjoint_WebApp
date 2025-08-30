<?php

namespace Infrastructure\Service\Twig;

use Domain\Dto\ExportReport\ReportDataDTO;
use Domain\Service\ExportReport\ContentReportBuilder;
use Twig\Environment;

class TwigContentReportBuilder implements ContentReportBuilder
{
    public function  __construct(
        private Environment $twig,
    ){}
    public function buildContent(ReportDataDTO $matchData)
    {
        return $this->twig->render('reports/content.html.twig', [
            'homePlayers' => $matchData->homePlayers,
            'awayPlayers' => $matchData->awayPlayers,
            'homeSubstitutes' => $matchData->homeSubstitutes,
            'awaySubstitutes' => $matchData->awaySubstitutes,
            'homeTeamName' => $matchData->homeTeamName,
            'awayTeamName' => $matchData->awayTeamName,
            'dateMatch' => $matchData->dateMatch,
            'stadiumName' => $matchData->stadiumName,
            'competitionName' => $matchData->competitionName,
            'matchInfos' => $matchData->matchInfos,
        ]);
    }
}
