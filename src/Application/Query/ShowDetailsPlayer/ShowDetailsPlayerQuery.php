<?php

namespace Application\Query\ShowDetailsPlayer;

use Domain\Mapper\ParticipationMapper;
use Domain\Mapper\PlayerMapper;
use Domain\Repository\Participation\ParticipationReadRepository;
use Domain\Repository\Player\PlayerReadRepository;
use Domain\Request\ShowDetailsPlayer\ShowDetailsPlayerRequest;
use Domain\Response\ShowDetailsPlayer\ShowDetailsPlayerResponse;

class ShowDetailsPlayerQuery
{
    public function __construct(
        private PlayerReadRepository $playerRepository,
        private ParticipationReadRepository $participationRepository,
        private ShowDetailsPlayerOutputBoundary $presenter,
    ){}

    public function execute(ShowDetailsPlayerRequest $request): ShowDetailsPlayerResponse
    {
        $player = $this->playerRepository->findById($request->idPlayer);
        $participations = $this->participationRepository->findByPlayer($player->getId());

        $response = new ShowDetailsPlayerResponse($player, $participations);
        $this->presenter->present($response);

        return $response;
    }

}
