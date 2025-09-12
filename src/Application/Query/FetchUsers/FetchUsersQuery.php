<?php

namespace Application\Query\FetchUsers;

use Domain\Mapper\UserMapper;
use Domain\Repository\UserRepository;
use Domain\Request\FetchUsers\FetchUsersRequest;
use Domain\Response\FetchUsers\FetchUsersResponse;

class FetchUsersQuery
{
    public function __construct(
        private UserRepository $userRepository,
        private UserMapper $userMapper,
    ){}

    public function execute(FetchUsersRequest $request): FetchUsersResponse
    {
        $users = [];
        $usersInfra = $this->userRepository->findAll();

        foreach($usersInfra as $userInfra)
        {
            $users[] = $this->userMapper->toDomain($userInfra);
        }

        $fetchUsersResponse = new FetchUsersResponse($users);
        return $fetchUsersResponse;
    }

}
