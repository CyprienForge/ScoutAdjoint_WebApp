<?php

namespace Infrastructure\Twig\Presenter;

use Domain\Presenter\ShowDetailsPlayer\ShowDetailsPlayerPresenter;
use Domain\Response\ShowDetailsPlayer\ShowDetailsPlayerResponse;
use Domain\ViewModel\Entity\ParticipationViewModel;
use Domain\ViewModel\Entity\PlayerViewModel;
use Domain\ViewModel\ShowDetailsPlayer\ShowDetailsPlayerViewModel;

class ShowDetailsPlayerTwigPresenter implements ShowDetailsPlayerPresenter
{
    private ShowDetailsPlayerViewModel $viewModel;
    public function present(ShowDetailsPlayerResponse $response): void
    {
        $this->viewModel = new ShowDetailsPlayerViewModel();
        $player = $response->player;

        $this->viewModel->playerViewModel = new PlayerViewModel(
            0,
            $player->getId(),
            $player->getFirstName(),
            $player->getLastName(),
            $player->getTeam()->getName(),
            $player->getBirthDate()->format('Y-m-d'),
            $player->getTransfermarktUrl()
        );

        $this->viewModel->displayTransfermarkt = $player->getTransfermarktUrl() == null ? 'none' : 'block';

        $indexLoop = 1;
        foreach($response->participations as $participation){
            $match = $participation->getMatch();
            $teamOpponent = $match->getHomeTeam()->getId() != $participation->getTeam()->getId() ? $match->getHomeTeam() : $match->getAwayTeam();
            $teamOpponentName = $teamOpponent->getName();

            $this->viewModel->participationViewModels[] = new ParticipationViewModel(
                $indexLoop,
                $participation->getMatch()->getId(),
                $participation->getMatch()->getDate()->format('d-m-Y'),
                '',
                $participation->getTeam()->getName(),
                $teamOpponentName,
                $participation->getNumero(),
                $participation->getTeam()->getId(),
            );
            $indexLoop++;
        }
    }

    public function getPresentation()
    {
        return $this->viewModel;
    }
}
