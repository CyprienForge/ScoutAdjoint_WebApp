<?php

namespace Domain\Presenter\FetchTeams;

use Domain\Response\FetchTeams\FetchTeamsResponse;
use Domain\UseCase\FetchTeams\FetchTeamsOutputBoundary;
use Domain\ViewModel\Entity\TeamViewModel;
use Domain\ViewModel\FetchTeams\FetchTeamsViewModel;

class FetchTeamsPresenter implements FetchTeamsOutputBoundary
{
    private FetchTeamsViewModel $viewModel;

    public function present(FetchTeamsResponse $response)
    {
        $this->viewModel = new FetchTeamsViewModel();

        foreach($response->teams as $team){
            $this->viewModel->teamViewModels[] = new TeamViewModel(
                $team->getName(),
            );
        }
    }

    public function getViewModel(): FetchTeamsViewModel
    {
        return $this->viewModel;
    }
}
