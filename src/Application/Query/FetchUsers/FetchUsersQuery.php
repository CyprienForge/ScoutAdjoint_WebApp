<?php

namespace Application\Query\FetchUsers;

use Domain\Mapper\UserMapper;
use Domain\Presenter\FetchUsers\FetchUsersPresenter;
use Domain\Repository\User\UserReadRepository;
use Domain\Request\FetchUsers\FetchUsersRequest;
use Domain\Response\FetchUsers\FetchUsersResponse;

class FetchUsersQuery
{
    public function __construct(
        private UserReadRepository $userRepository,
        private FetchUsersPresenter $presenter
    ){}

    public function execute(FetchUsersRequest $request): FetchUsersResponse
    {
        $users = $this->userRepository->findAll();
        $fetchUsersResponse = new FetchUsersResponse($users);
        $this->presenter->present($fetchUsersResponse);

        return $fetchUsersResponse;
    }

}
