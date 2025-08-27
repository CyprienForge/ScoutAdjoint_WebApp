<?php

namespace Domain\UseCase\ExportReport;

use Domain\Dto\ExportReport\ReportDataDTO;
use Domain\Repository\MatchRepository;
use Domain\Repository\ParticipationRepository;
use Domain\Request\ExportReport\ExportReportRequest;
use Domain\Response\ExportReport\ExportReportResponse;
use Domain\Service\ExportReport\ContentReportBuilder;
use Domain\Service\ExportReport\ReportExporter;

class ExportReportUseCase
{
    public function __construct(
        private ReportExporter $reportExporter,
        private ContentReportBuilder $contentReportBuilder,
        private ParticipationRepository  $participationRepository,
        private MatchRepository $matchRepository,
    ){}

    public function execute(ExportReportRequest $request) : ExportReportResponse
    {
        $match = $this->matchRepository->findById($request->idMatch);
        $participations = $this->participationRepository->findByMatch($match->getId());

        $homeTeamPlayers = [];
        $awayTeamPlayers = [];
        foreach($participations as $participation)
        {
            if($participation->getTeam()->getId() === $match->getHomeTeam()->getId()){
                if(count($homeTeamPlayers) < 11){
                    $homeTeamPlayers[] = $participation;
                }
            }
            if($participation->getTeam()->getId() === $match->getAwayTeam()->getId()){
                if(count($awayTeamPlayers) < 11){
                    $awayTeamPlayers[] = $participation;
                }
            }
        }

        $reportDataDTO = new ReportDataDTO(
            $homeTeamPlayers,
            $awayTeamPlayers,
            [],
            []
        );
        $content = $this->contentReportBuilder->buildContent($reportDataDTO);
        $this->reportExporter->export($content);

        return new ExportReportResponse();
    }

}
