<?php

namespace Application\Query\ShowDetailsMatch;

use Domain\Dto\ShowDetailsMatch\ParticipationNotesDTO;
use Domain\Mapper\ParticipationMapper;
use Domain\Repository\Note\NoteReadRepository;
use Domain\Repository\Participation\ParticipationReadRepository;
use Domain\Request\ShowDetailsMatch\ShowDetailsMatchRequest;
use Domain\Response\ShowDetailsMatch\ShowDetailsMatchResponse;

class ShowDetailsMatchQuery
{
    public function __construct(
        private ParticipationReadRepository $participationRepository,
        private NoteReadRepository $noteRepository,
        private ParticipationMapper $participationMapper,
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
