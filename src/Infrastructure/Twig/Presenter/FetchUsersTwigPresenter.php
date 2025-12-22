<?php

namespace Infrastructure\Twig\Presenter;

use Domain\Presenter\FetchUsers\FetchUsersPresenter;
use Domain\Response\FetchUsers\FetchUsersResponse;
use Domain\ViewModel\Entity\UserViewModel;
use Domain\ViewModel\FetchUsers\FetchUsersViewModel;

class FetchUsersTwigPresenter implements FetchUsersPresenter
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


    public function getPresentation(): FetchUsersViewModel
    {
        return $this->usersViewModel;
    }
}
