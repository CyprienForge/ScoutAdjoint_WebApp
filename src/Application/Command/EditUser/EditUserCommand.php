<?php

namespace Application\Command\EditUser;

use Domain\Exception\EditUser\EditCurrentPlayerException;
use Domain\Mapper\UserMapper;
use Domain\Repository\UserRepository;
use Domain\Request\EditUser\EditUserRequest;
use Domain\Response\EditUser\EditUserResponse;

class EditUserCommand
{
    public function __construct(
        private UserRepository $userRepository,
        private UserMapper $userMapper
    ){}

    public function execute(EditUserRequest $request): EditUserResponse
    {
        if($request->user->getId() == $request->idCurrentUser){
            throw new EditCurrentPlayerException("Vous essayez de modifier votre compte en étant connecté !");
        }

        $request->newRoles[] = 'ROLE_USER';

        $request->user->setRoles(array_values($request->newRoles));
        $userInfra = $this->userMapper->toInfra($request->user);
        $this->userRepository->save($userInfra);

        return new EditUserResponse();
    }

}
