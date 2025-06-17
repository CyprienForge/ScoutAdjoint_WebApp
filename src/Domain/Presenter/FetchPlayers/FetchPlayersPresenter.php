<?php

namespace Domain\Presenter\FetchPlayers;

use Domain\Response\FetchPlayers\FetchPlayersResponse;
use Domain\UseCase\FetchPlayers\FetchPlayersOutputBoundary;
use Domain\ViewModel\FetchPlayers\FetchPlayersViewModel;

class FetchPlayersPresenter implements FetchPlayersOutputBoundary
{
    private array $viewModels = [];

    public function present(FetchPlayersResponse $response): void
    {
        foreach($response->getPlayers() as $player){
            $viewModel = new FetchPlayersViewModel(
                $player->getFirstName() .  ' ' . $player->getLastName(),
                $player->getTeam()->getName()
            );
            $this->viewModels[] = $viewModel;
        }
    }

    public function getViewModel() : array
    {
        return $this->viewModels;
    }
}
