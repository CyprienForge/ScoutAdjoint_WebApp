<?php

namespace Domain\UseCase\EditUser;

use Domain\Mapper\UserMapper;
use Domain\Repository\UserRepository;
use Domain\Request\EditUser\EditUserRequest;
use Domain\Response\EditUser\EditUserResponse;

class EditUserUseCase
{
    public function __construct(
        private UserRepository $userRepository,
        private UserMapper $userMapper
    ){}

    public function execute(EditUserRequest $request): EditUserResponse
    {
        $request->user->setRoles($request->newRoles);
        $userInfra = $this->userMapper->toInfra($request->user);
        $this->userRepository->save($userInfra);

        return new EditUserResponse();
    }

}
