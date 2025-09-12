<?php

namespace Domain\Presenter\EditGlobalInfosMatch;

use Application\UseCase\EditGlobalInfosMatch\EditGlobalInfosMatchOutputBoundary;
use Domain\Response\EditGlobalInfosMatch\EditGlobalInfosMatchResponse;
use Domain\ViewModel\EditGlobalInfosMatch\EditGlobalInfosMatchViewModel;

class EditGlobalInfosMatchPresenter implements EditGlobalInfosMatchOutputBoundary
{
    private EditGlobalInfosMatchViewModel $viewModel;

    public function present(EditGlobalInfosMatchResponse $response)
    {
        $this->viewModel = new EditGlobalInfosMatchViewModel(
            $response->match->getId(),
            $response->match->getHomeTeam()->getName(),
            $response->match->getAwayTeam()->getName(),
            $response->match->getHomeTeam()->getId(),
            $response->match->getAwayTeam()->getId(),
            '',
            ''
        );
    }

    public function getViewModel()
    {
        return $this->viewModel;
    }
}
