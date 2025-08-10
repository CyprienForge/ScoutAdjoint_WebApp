<?php

namespace Domain\UseCase\ShowDetailsMatch;

use Domain\Dto\ShowDetailsMatch\ParticipationNotesDTO;
use Domain\Mapper\NoteMapper;
use Domain\Mapper\ParticipationMapper;
use Domain\Repository\MatchRepository;
use Domain\Repository\NoteRepository;
use Domain\Repository\ParticipationRepository;
use Domain\Request\ShowDetailsMatch\ShowDetailsMatchRequest;
use Domain\Response\ShowDetailsMatch\ShowDetailsMatchResponse;
use Domain\Response\ShowDetailsPlayer\ShowDetailsPlayerResponse;

class ShowDetailsMatchUseCase
{

    public function __construct(
        private MatchRepository $matchRepository,
        private ParticipationRepository $participationRepository,
        private NoteRepository $noteRepository,
        private ParticipationMapper $participationMapper,
        private NoteMapper $noteMapper,
        private ShowDetailsMatchOutputBoundary $presenter
    ){}

    public function execute(ShowDetailsMatchRequest $request) : ShowDetailsMatchResponse
    {
        $participationsNotes = [];
        $participations = $this->participationRepository->findByMatchAndTeam($request->matchId, $request->teamId);

        foreach($participations as $participation)
        {
            $participation = $this->participationMapper->toDomain($participation);
            $notesInfra = $this->noteRepository->findByParticipation($participation->getId());
            $notes = [];
            foreach($notesInfra as $note)
            {
                $notes[] = $this->noteMapper->toDomain($note);
            }

            $participationsNotes[] = new ParticipationNotesDTO($participation, $notes);
        }

        $response = new ShowDetailsMatchResponse($participationsNotes, $request->teamId);
        $this->presenter->present($response);

        return $response;
    }
}
