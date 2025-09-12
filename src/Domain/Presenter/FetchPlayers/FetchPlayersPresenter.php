<?php

namespace Domain\Presenter\FetchPlayers;

use Application\Query\FetchPlayers\FetchPlayersOutputBoundary;
use Domain\Response\FetchPlayers\FetchPlayersResponse;
use Domain\ViewModel\Entity\PlayerViewModel;
use Domain\ViewModel\FetchPlayers\FetchPlayersViewModel;

class FetchPlayersPresenter implements FetchPlayersOutputBoundary
{
    private FetchPlayersViewModel $viewModel;

    public function present(FetchPlayersResponse $response): void
    {
        $this->viewModel = new FetchPlayersViewModel();
        $this->viewModel->pageNumber = $response->getPageNumber();
        $this->viewModel->previousPageNumber = (string)((int) $response->getPageNumber() - 1);
        $this->viewModel->previousPageNumber = $this->viewModel->previousPageNumber < 0 ? 0 : $this->viewModel->previousPageNumber;
        $this->viewModel->nextPageNumber = (string)((int) $response->getPageNumber() + 1);

        $indexLoop = 1;
        foreach($response->getPlayers() as $player){
            $positionLoop = $response->getPageNumber() * $response->getLimit() + $indexLoop;
            $this->viewModel->playerViewModels[] = new PlayerViewModel(
                $positionLoop,
                $player->getId(),
                $player->getFirstName(),
                $player->getLastName(),
                $player->getTeam()->getName(),
                $player->getBirthDate()->format('d-m-Y'),
                $player->getTransfermarktUrl()
            );
            $indexLoop++;
        }

        $this->viewModel->nextPageNumber = $indexLoop < $response->getLimit() ? $response->getPageNumber() : $this->viewModel->nextPageNumber;
    }

    public function getViewModel() : FetchPlayersViewModel
    {
        return $this->viewModel;
    }
}
