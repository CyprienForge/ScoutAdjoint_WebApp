<?php

namespace Domain\Presenter\FetchUsers;

use Domain\Response\FetchUsers\FetchUsersResponse;
use Domain\UseCase\FetchUsers\FetchUsersOutputBoundary;
use Domain\ViewModel\Entity\UserViewModel;
use Domain\ViewModel\FetchUsers\FetchUsersViewModel;

class FetchUsersPresenter implements FetchUsersOutputBoundary
{
    private FetchUsersViewModel $usersViewModel;

    public function present(FetchUsersResponse $response)
    {
        $this->usersViewModel = new FetchUsersViewModel();
        $index = 1;

        foreach($response->users as $user)
        {
            $userViewModel = new UserViewModel(
                $user->getId(),
                $user->getIdentifier(),
                $user->getEmail(),
                $user->getRoles(),
                $index
            );

            $this->usersViewModel->users[] = $userViewModel;
            $index++;
        }
    }


    public function getViewModel(): FetchUsersViewModel
    {
        return $this->usersViewModel;
    }
}
