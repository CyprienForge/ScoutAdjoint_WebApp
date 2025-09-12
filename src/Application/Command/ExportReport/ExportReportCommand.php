<?php

namespace Application\Command\ExportReport;

use Domain\Dto\ExportReport\ReportDataDTO;
use Domain\Mapper\MatchInfosMapper;
use Domain\Mapper\MatchMapper;
use Domain\Repository\MatchInfosRepository;
use Domain\Repository\MatchRepository;
use Domain\Repository\NoteRepository;
use Domain\Repository\ParticipationRepository;
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
        private ParticipationRepository  $participationRepository,
        private MatchRepository $matchRepository,
        private ExportReportOutputBoundary $presenter,
        private NoteRepository $noteRepository,
        private MatchInfosRepository $matchInfosRepository,
        private MatchInfosMapper $matchInfosMapper,
        private MatchMapper $matchMapper
    ){}

    public function execute(ExportReportRequest $request) : ExportReportResponse
    {
        $matchInfra = $this->matchRepository->findById($request->idMatch);
        $match = $this->matchMapper->toDomain($matchInfra);
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

        $matchInfosInfra = $this->matchInfosRepository->findByMatch($match->getId());
        $matchInfos = $this->matchInfosMapper->toDomain($matchInfosInfra);

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
        $this->reportExporter->export($content, $fileName);

        return new ExportReportResponse();
    }

}
