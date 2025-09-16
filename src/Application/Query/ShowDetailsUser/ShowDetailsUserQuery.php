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
    ){}

    public function execute(ShowDetailsUserRequest $request): ShowDetailsUserResponse
    {
        $user = $this->userRepository->findById($request->idUser);
        return new ShowDetailsUserResponse($user);
    }

}
