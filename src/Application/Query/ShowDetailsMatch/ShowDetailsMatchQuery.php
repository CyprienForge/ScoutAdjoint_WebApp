<?php

namespace Application\Query\ShowDetailsMatch;

use Domain\Dto\ShowDetailsMatch\ParticipationNotesDTO;
use Domain\Mapper\NoteMapper;
use Domain\Mapper\ParticipationMapper;
use Domain\Repository\MatchRepository;
use Domain\Repository\NoteRepository;
use Domain\Repository\ParticipationRepository;
use Domain\Request\ShowDetailsMatch\ShowDetailsMatchRequest;
use Domain\Response\ShowDetailsMatch\ShowDetailsMatchResponse;

class ShowDetailsMatchQuery
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
            $notes = $this->noteRepository->findByParticipation($participation->getId());

            $participationsNotes[] = new ParticipationNotesDTO($participation, $notes);
        }

        $response = new ShowDetailsMatchResponse($participationsNotes, $request->teamId);
        $this->presenter->present($response);

        return $response;
    }
}
