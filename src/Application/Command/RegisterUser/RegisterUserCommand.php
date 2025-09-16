<?php

namespace Application\Command\RegisterUser;

use Domain\Entity\User;
use Domain\Exception\DomainException;
use Domain\Exception\RegisterUser\IdentifierOrEmailAlreadyUsedException;
use Domain\Mapper\UserMapper;
use Domain\Repository\User\UserReadRepository;
use Domain\Repository\User\UserWriteRepository;
use Domain\Request\RegisterUser\RegisterUserRequest;
use Domain\Response\RegisterUser\RegisterUserResponse;
use Domain\Service\RegisterUser\PasswordHasher;
use Domain\Validator\RegisterUser\UserValidator;

class RegisterUserCommand
{
    public function __construct(
        private UserWriteRepository $userWriteRepository,
        private UserReadRepository $userRepository,
        private PasswordHasher $passwordHasher,
        private UserValidator $userValidator
    ){}

    public function execute(RegisterUserRequest $request): RegisterUserResponse
    {
        try{
            $this->userValidator->validate($request->identifier, $request->email, $request->password);
        }catch (DomainException $e){
            throw $e;
        }

        $user = $this->userRepository->findByIdentifier($request->identifier);
        if($user != null){
            throw new IdentifierOrEmailAlreadyUsedException("L'identifiant et / ou l'email sont déjà associés à un compte");
        }

        $user = $this->userRepository->findByEmail($request->email);
        if($user != null){
            throw new IdentifierOrEmailAlreadyUsedException("L'identifiant et / ou l'email sont déjà associés à un compte");
        }

        $passwordHash = $this->passwordHasher->hash($request->password);
        $user = new User();
        $user->setId(null);
        $user->setEmail($request->email);
        $user->setPassword($passwordHash);
        $user->setIdentifier($request->identifier);
        $user->setRoles(['ROLE_USER']);

        $this->userWriteRepository->save($user);
        $user->setId($this->userWriteRepository->getLastInsertId());
        return new RegisterUserResponse($user);
    }

}
