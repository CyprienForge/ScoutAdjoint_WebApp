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
        $index = 0;
        foreach($response->getPlayers() as $player) {
            $playerDto = new PlayerJsonDto();
            $this->result[] = $playerDto->toDto($player, $response->getPositions()[$index]);
            $index++;
        }
    }

    public function getPresentation()
    {
        return $this->result;
    }
}
