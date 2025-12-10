<?php

namespace Application\Query\ShowDetailsPlayer;

use Domain\Exception\ShowDetailsPlayer\PlayerNotFoundException;
use Domain\Presenter\ShowDetailsPlayer\ShowDetailsPlayerPresenter;
use Domain\Repository\Participation\ParticipationReadRepository;
use Domain\Repository\Player\PlayerReadRepository;
use Domain\Request\ShowDetailsPlayer\ShowDetailsPlayerRequest;
use Domain\Response\ShowDetailsPlayer\ShowDetailsPlayerResponse;

class ShowDetailsPlayerQuery
{
    public function __construct(
        private PlayerReadRepository        $playerRepository,
        private ParticipationReadRepository $participationRepository,
        private ShowDetailsPlayerPresenter  $presenter,
    ){}

    public function execute(ShowDetailsPlayerRequest $request): ShowDetailsPlayerResponse
    {
        try{
            $player = $this->playerRepository->findById($request->idPlayer);
        }catch (PlayerNotFoundException $e){
            throw $e;
        }
        $participations = $this->participationRepository->findByPlayer($player->getId());

        $response = new ShowDetailsPlayerResponse($player, $participations);
        $this->presenter->present($response);

        return $response;
    }

}
