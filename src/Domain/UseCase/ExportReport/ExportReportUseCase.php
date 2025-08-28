<?php

namespace Domain\UseCase\ExportReport;

use Domain\Dto\ExportReport\ReportDataDTO;
use Domain\Repository\MatchRepository;
use Domain\Repository\NoteRepository;
use Domain\Repository\ParticipationRepository;
use Domain\Request\ExportReport\ExportReportRequest;
use Domain\Response\ExportReport\ExportReportResponse;
use Domain\Service\ExportReport\ContentReportBuilder;
use Domain\Service\ExportReport\ReportExporter;
use Domain\ViewModel\ExportReport\ExportReportPlayerViewModel;

class ExportReportUseCase
{
    public function __construct(
        private ReportExporter $reportExporter,
        private ContentReportBuilder $contentReportBuilder,
        private ParticipationRepository  $participationRepository,
        private MatchRepository $matchRepository,
        private ExportReportOutputBoundary $presenter,
        private NoteRepository $noteRepository,
    ){}

    public function execute(ExportReportRequest $request) : ExportReportResponse
    {
        $match = $this->matchRepository->findById($request->idMatch);
        $participations = $this->participationRepository->findByMatch($match->getId());

        $homeTeamPlayers = [];
        $homeTeamSubstitutes = [];
        $awayTeamPlayers = [];
        $awayTeamSubstitutes = [];
        foreach($participations as $participation)
        {
            if($participation->getTeam()->getId() === $match->getHomeTeam()->getId()){
                $exportPlayerViewModel = new ExportReportPlayerViewModel(
                    $participation,
                    $this->noteRepository->findByParticipation($participation->getId())
                );
                if($participation->isSubstitute()){
                    $homeTeamSubstitutes[] = $exportPlayerViewModel;
                }else $homeTeamPlayers[] = $exportPlayerViewModel;
            }
            if($participation->getTeam()->getId() === $match->getAwayTeam()->getId()){
                $exportPlayerViewModel = new ExportReportPlayerViewModel(
                    $participation,
                    $this->noteRepository->findByParticipation($participation->getId())
                );
                if($participation->isSubstitute()){
                    $awayTeamSubstitutes[] = $exportPlayerViewModel;
                }else $awayTeamPlayers[] = $exportPlayerViewModel;
            }
        }

        $reportDataDTO = new ReportDataDTO(
            $homeTeamPlayers,
            $awayTeamPlayers,
            $homeTeamSubstitutes,
            $awayTeamSubstitutes,
            $match->getHomeTeam()->getName(),
            $match->getAwayTeam()->getName(),
        );
        $content = $this->contentReportBuilder->buildContent($reportDataDTO);
        $this->reportExporter->export($content);

        return new ExportReportResponse();
    }

}
