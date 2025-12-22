<?php

namespace Application\Command\ExportReport;

use Domain\Dto\ExportReport\ReportDataDTO;
use Domain\Mapper\MatchInfosMapper;
use Domain\Mapper\MatchMapper;
use Domain\Repository\Match\MatchReadRepository;
use Domain\Repository\Match\MatchRepository;
use Domain\Repository\MatchInfos\MatchInfosReadRepository;
use Domain\Repository\MatchInfos\MatchInfosRepository;
use Domain\Repository\Note\NoteReadRepository;
use Domain\Repository\Note\NoteRepository;
use Domain\Repository\Participation\ParticipationReadRepository;
use Domain\Repository\Participation\ParticipationRepository;
use Domain\Request\ExportReport\ExportReportRequest;
use Domain\Response\ExportReport\ExportReportResponse;
use Domain\Service\ExportReport\ContentReportBuilder;
use Domain\Service\ExportReport\ReportExporter;
use Domain\ViewModel\ExportReport\ExportReportPlayerViewModel;

class ExportReportCommand
{
    public function __construct(
        private ReportExporter $reportExporter,
        private ContentReportBuilder $contentReportBuilder,
        private ParticipationReadRepository  $participationRepository,
        private MatchReadRepository $matchRepository,
        private NoteReadRepository $noteRepository,
        private MatchInfosReadRepository $matchInfosRepository,
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

        $matchInfos = $this->matchInfosRepository->findByMatch($match->getId());

        $reportDataDTO = new ReportDataDTO(
            $homeTeamPlayers,
            $awayTeamPlayers,
            $homeTeamSubstitutes,
            $awayTeamSubstitutes,
            $match->getHomeTeam()->getName(),
            $match->getAwayTeam()->getName(),
            $match->getDate()->format('d/m/Y H:i'),
            $match->getStadium()->getName(),
            $match->getChampionship()->getName(),
            $matchInfos
        );
        $fileName = $match->getHomeTeam()->getName() . '_' . $match->getAwayTeam()->getName() . '_' . $match->getDate()->format('dmYHis');

        $content = $this->contentReportBuilder->buildContent($reportDataDTO);
        $pdf = $this->reportExporter->export($content, $fileName);

        return new ExportReportResponse($pdf, $fileName);
    }

}
