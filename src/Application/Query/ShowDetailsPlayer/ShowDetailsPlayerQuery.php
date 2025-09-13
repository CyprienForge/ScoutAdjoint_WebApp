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
        private PlayerMapper $playerMapper,
        private ParticipationMapper $participationMapper,
    ){}

    public function execute(ShowDetailsPlayerRequest $request): ShowDetailsPlayerResponse
    {
        $player = $this->playerRepository->findById($request->idPlayer);
        $player = $this->playerMapper->toDomain($player);

        $participationsInfra = $this->participationRepository->findByPlayer($player->getId());
        $participations = [];
        foreach($participationsInfra as $participation){
            $participations[] = $this->participationMapper->toDomain($participation);
        }

        $response = new ShowDetailsPlayerResponse($player, $participations);
        $this->presenter->present($response);

        return $response;
    }

}
