<?php

namespace Domain\Presenter\ShowDetailsUser;

use Domain\Response\ShowDetailsUser\ShowDetailsUserResponse;
use Domain\UseCase\ShowDetailsUser\ShowDetailsUserOutputBoundary;
use Domain\ViewModel\Entity\UserViewModel;

class ShowDetailsUserPresenter implements ShowDetailsUserOutputBoundary
{
    private UserViewModel $userViewModel;

    public function present(ShowDetailsUserResponse $response)
    {
        $this->userViewModel = new UserViewModel(
            $response->user->getId(),
            $response->user->getIdentifier(),
            $response->user->getEmail(),
            $response->user->getRoles(),
            0
        );
    }

    public function getViewModel()
    {
        return $this->userViewModel;
    }
}
