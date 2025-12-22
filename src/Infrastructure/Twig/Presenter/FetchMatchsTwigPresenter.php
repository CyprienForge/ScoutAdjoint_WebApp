<?php

namespace Infrastructure\Twig\Presenter;

use Domain\Presenter\FetchMatchs\FetchMatchsPresenter;
use Domain\Response\FetchMatchs\FetchMatchsResponse;
use Domain\ViewModel\Entity\MatchViewModel;
use Domain\ViewModel\FetchMatchs\FetchMatchsViewModel;

class FetchMatchsTwigPresenter implements FetchMatchsPresenter
{
    private FetchMatchsViewModel $viewModel;

    public function present(FetchMatchsResponse $response): void
    {
        $this->viewModel = new FetchMatchsViewModel();

        foreach($response->getMatchs() as $match)
        {
            $this->viewModel->matchsViewModels[] = new MatchViewModel(
                $match->getId(),
                $match->getDate()->format('d/m/Y'),
                $match->getScoreHome(),
                $match->getScoreAway(),
                $match->getHomeTeam()->getId(),
                $match->getHomeTeam()->getName(),
                $match->getAwayTeam()->getName(),
            );
        }
    }

    public function getViewModel(): FetchMatchsViewModel
    {
        return $this->viewModel;
    }

    public function getPresentation() : FetchMatchsViewModel
    {
        return $this->viewModel;
    }
}
