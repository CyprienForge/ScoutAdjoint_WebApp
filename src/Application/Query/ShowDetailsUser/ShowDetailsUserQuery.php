<?php

namespace Application\Query\ShowDetailsUser;

use Domain\Mapper\UserMapper;
use Domain\Repository\User\UserReadRepository;
use Domain\Request\ShowDetailsUser\ShowDetailsUserRequest;
use Domain\Response\ShowDetailsUser\ShowDetailsUserResponse;

class ShowDetailsUserQuery
{
    public function __construct(
        private UserReadRepository $userRepository,
        private UserMapper $userMapper
    ){}

    public function execute(ShowDetailsUserRequest $request): ShowDetailsUserResponse
    {
        $userInfra = $this->userRepository->findById($request->idUser);
        $user = $this->userMapper->toDomain($userInfra);

        return new ShowDetailsUserResponse($user);
    }

}
