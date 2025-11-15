<?php

namespace Infrastructure\Json\Presenter;

use Domain\Presenter\FetchPlayers\FetchPlayersPresenter;
use Domain\Response\FetchPlayers\FetchPlayersResponse;
use Infrastructure\Json\Dto\PlayerJsonDto;

class FetchPlayersJsonPresenter implements FetchPlayersPresenter
{
    private array $result = [];

    public function present(FetchPlayersResponse $response): void
    {
        foreach($response->getPlayers() as $player) {
            $playerDto = new PlayerJsonDto();
            $this->result[] = $playerDto->toDto($player);
        }
    }

    public function getPresentation()
    {
        return $this->result;
    }
}
