<?php

namespace Infrastructure\Twig\Presenter;

use Domain\Presenter\FetchTeams\FetchTeamsPresenter;
use Domain\Response\FetchTeams\FetchTeamsResponse;
use Domain\ViewModel\Entity\TeamViewModel;
use Domain\ViewModel\FetchTeams\FetchTeamsViewModel;

class FetchTeamsTwigPresenter implements FetchTeamsPresenter
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
