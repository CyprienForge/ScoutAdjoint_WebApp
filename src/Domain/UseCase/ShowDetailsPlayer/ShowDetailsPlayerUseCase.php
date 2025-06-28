<?php

namespace Domain\UseCase\ShowDetailsPlayer;

use Domain\Repository\PlayerRepository;
use Domain\Request\ShowDetailsPlayer\ShowDetailsPlayerRequest;
use Domain\Response\ShowDetailsPlayer\ShowDetailsPlayerResponse;
use Infrastructure\Entity\Doctrine\Mapper\PlayerMapperDoctrine;

class ShowDetailsPlayerUseCase
{
    public function __construct(
        private PlayerRepository $playerRepository,
        private ShowDetailsPlayerOutputBoundary $presenter
    ){}

    public function execute(ShowDetailsPlayerRequest $request): ShowDetailsPlayerResponse
    {
        $player = $this->playerRepository->findById($request->idPlayer);
        $player = PlayerMapperDoctrine::toDomain($player);

        $response = new ShowDetailsPlayerResponse($player);
        $this->presenter->present($response);

        return $response;
    }

}
