<?php

namespace Application\Command\DeleteUser;

use Domain\Exception\DeleteUser\DeleteCurrentUserException;
use Domain\Repository\User\UserWriteRepository;
use Domain\Request\DeleteUser\DeleteUserRequest;
use Domain\Response\DeleteUser\DeleteUserResponse;

class DeleteUserCommand
{

    public function __construct(
        private UserWriteRepository $userRepository,
    ){}

    public function execute(DeleteUserRequest $request): DeleteUserResponse
    {
        if($request->currentUser->getId() == $request->idUserToDelete)
        {
            throw new DeleteCurrentUserException("Vous essayez de supprimer votre compte en étant connecté !");
        }
        $this->userRepository->deleteById($request->idUserToDelete);

        return new DeleteUserResponse();
    }

}
