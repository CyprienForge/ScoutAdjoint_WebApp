<?php

namespace Domain\Presenter\FetchPlayers;

use Domain\Response\FetchPlayers\FetchPlayersResponse;
use Domain\UseCase\FetchPlayers\FetchPlayersOutputBoundary;
use Domain\ViewModel\FetchPlayers\FetchPlayersViewModel;

class FetchPlayersPresenter implements FetchPlayersOutputBoundary
{
    private array $viewModels = [];
    public string $pageNumber;
    public string $pagePreviousNumber;
    public string $pageNextNumber;

    public function present(FetchPlayersResponse $response): void
    {
        $this->pageNumber = $response->getPageNumber();
        $this->pagePreviousNumber = (string)((int) $response->getPageNumber() - 1);
        $this->pagePreviousNumber = $this->pagePreviousNumber < 0 ? 0 : $this->pagePreviousNumber;
        $this->pageNextNumber = (string)((int) $response->getPageNumber() + 1);

        $indexLoop = 1;
        foreach($response->getPlayers() as $player){
            $positionLoop = $response->getPageNumber() * $response->getLimit() + $indexLoop;
            $viewModel = new FetchPlayersViewModel(
                $positionLoop,
                $player->getFirstName(),
                $player->getLastName(),
                $player->getTeam()->getName(),
                $player->getBirthDate()->format('d-m-Y')
            );
            $this->viewModels[] = $viewModel;
            $indexLoop++;
        }

        $this->pageNextNumber = $indexLoop < $response->getLimit() ? $response->getPageNumber() : $this->pageNextNumber;
    }

    public function getViewModel() : array
    {
        return $this->viewModels;
    }

    public function getPageNumber() : string
    {
        return $this->pageNumber;
    }

    public function getPageNextNumber(): string
    {
        return $this->pageNextNumber;
    }

    public function getPagePreviousNumber(): string
    {
        return $this->pagePreviousNumber;
    }
}
