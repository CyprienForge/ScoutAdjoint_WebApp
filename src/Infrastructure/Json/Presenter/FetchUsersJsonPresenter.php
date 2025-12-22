<?php

namespace Infrastructure\Json\Presenter;

use Domain\Presenter\FetchUsers\FetchUsersPresenter;
use Domain\Response\FetchUsers\FetchUsersResponse;
use Infrastructure\Json\Dto\UserJsonDto;

class FetchUsersJsonPresenter implements FetchUsersPresenter
{
    private array $result = [];

    public function present(FetchUsersResponse $response)
    {
        foreach ($response->users as $user)
        {
            $dto = new UserJsonDto();
            $this->result[] = $dto->toDto($user);
        }
    }

    public function getPresentation()
    {
        return $this->result;
    }
}
