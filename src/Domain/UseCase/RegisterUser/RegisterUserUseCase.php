<?php

namespace Domain\UseCase\RegisterUser;

use Domain\Entity\User;
use Domain\Exception\DomainException;
use Domain\Exception\RegisterUser\IdentifierOrEmailAlreadyUsedException;
use Domain\Mapper\UserMapper;
use Domain\Repository\UserRepository;
use Domain\Request\RegisterUser\RegisterUserRequest;
use Domain\Response\RegisterUser\RegisterUserResponse;
use Domain\Service\RegisterUser\PasswordHasher;
use Domain\Validator\RegisterUser\UserValidator;

class RegisterUserUseCase
{
    public function __construct(
        private UserRepository $userRepository,
        private UserMapper $userMapper,
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

        $userInfra = $this->userRepository->findByIdentifier($request->identifier);
        if($userInfra != null){
            throw new IdentifierOrEmailAlreadyUsedException("L'identifiant et / ou l'email sont déjà associés à un compte");
        }

        $userInfra = $this->userRepository->findByEmail($request->email);
        if($userInfra != null){
            throw new IdentifierOrEmailAlreadyUsedException("L'identifiant et / ou l'email sont déjà associés à un compte");
        }

        $passwordHash = $this->passwordHasher->hash($request->password);
        $user = new User();
        $user->setId(null);
        $user->setEmail($request->email);
        $user->setPassword($passwordHash);
        $user->setIdentifier($request->identifier);
        $user->setRoles(['ROLE_USER']);

        $userInfra = $this->userMapper->toInfra($user);
        $this->userRepository->save($userInfra);
        $user = $this->userMapper->toDomain($userInfra);

        return new RegisterUserResponse($user);
    }

}
