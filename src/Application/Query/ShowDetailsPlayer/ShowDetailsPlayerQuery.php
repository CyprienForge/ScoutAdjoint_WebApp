<?php

namespace Application\Query\ShowDetailsPlayer;

use Domain\Mapper\ParticipationMapper;
use Domain\Mapper\PlayerMapper;
use Domain\Repository\ParticipationRepository;
use Domain\Repository\PlayerRepository;
use Domain\Request\ShowDetailsPlayer\ShowDetailsPlayerRequest;
use Domain\Response\ShowDetailsPlayer\ShowDetailsPlayerResponse;

class ShowDetailsPlayerQuery
{
    public function __construct(
        private PlayerRepository $playerRepository,
        private ParticipationRepository $participationRepository,
        private ShowDetailsPlayerOutputBoundary $presenter,
        private PlayerMapper $playerMapper,
        private ParticipationMapper $participationMapper,
    ){}

    public function execute(ShowDetailsPlayerRequest $request): ShowDetailsPlayerResponse
    {
        $player = $this->playerRepository->findById($request->idPlayer);
        $player = $this->playerMapper->toDomain($player);

        $participationsInfra = $this->participationRepository->findByIdPlayer($player->getId());
        $participations = [];
        foreach($participationsInfra as $participation){
            $participations[] = $this->participationMapper->toDomain($participation);
        }

        $response = new ShowDetailsPlayerResponse($player, $participations);
        $this->presenter->present($response);

        return $response;
    }

}
