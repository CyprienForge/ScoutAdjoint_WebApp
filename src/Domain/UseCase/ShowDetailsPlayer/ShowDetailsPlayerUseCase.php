<?php

namespace Domain\UseCase\ShowDetailsPlayer;

use Domain\Repository\ParticipationRepository;
use Domain\Repository\PlayerRepository;
use Domain\Request\ShowDetailsPlayer\ShowDetailsPlayerRequest;
use Domain\Response\ShowDetailsPlayer\ShowDetailsPlayerResponse;
use Infrastructure\Entity\Doctrine\Mapper\ParticipationMapperDoctrine;
use Infrastructure\Entity\Doctrine\Mapper\PlayerMapperDoctrine;

class ShowDetailsPlayerUseCase
{
    public function __construct(
        private PlayerRepository $playerRepository,
        private ParticipationRepository $participationRepository,
        private ShowDetailsPlayerOutputBoundary $presenter
    ){}

    public function execute(ShowDetailsPlayerRequest $request): ShowDetailsPlayerResponse
    {
        $player = $this->playerRepository->findById($request->idPlayer);
        $player = PlayerMapperDoctrine::toDomain($player);

        $participationsInfra = $this->participationRepository->findByIdPlayer($player->getId());
        $participations = [];
        foreach($participationsInfra as $participation){
            $participations[] = ParticipationMapperDoctrine::toDomain($participation);
        }

        $response = new ShowDetailsPlayerResponse($player, $participations);
        $this->presenter->present($response);

        return $response;
    }

}
