<?php

namespace Application\Query\FetchUsers;

use Domain\Mapper\UserMapper;
use Domain\Repository\User\UserReadRepository;
use Domain\Request\FetchUsers\FetchUsersRequest;
use Domain\Response\FetchUsers\FetchUsersResponse;

class FetchUsersQuery
{
    public function __construct(
        private UserReadRepository $userRepository,
    ){}

    public function execute(FetchUsersRequest $request): FetchUsersResponse
    {
        $users = $this->userRepository->findAll();
        $fetchUsersResponse = new FetchUsersResponse($users);

        return $fetchUsersResponse;
    }

}
