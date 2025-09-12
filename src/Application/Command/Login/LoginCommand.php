<?php

namespace Application\Command\Login;

use Domain\Exception\Login\LoginFailedException;
use Domain\Mapper\UserMapper;
use Domain\Repository\UserRepository;
use Domain\Request\Login\LoginRequest;
use Domain\Response\Login\LoginResponse;
use Domain\Service\RegisterUser\PasswordHasher;

class LoginCommand
{
    public function __construct(
        private UserRepository $userRepository,
        private UserMapper $userMapper,
        private PasswordHasher $passwordHasher,
    ){}

    public function execute(LoginRequest $request): LoginResponse
    {
        $userInfraEmail = $this->userRepository->findByEmail($request->identifier_email);
        $userInfraIdentifier = $this->userRepository->findByIdentifier($request->identifier_email);
        if($userInfraEmail == null && $userInfraIdentifier == null)
        {
            throw new LoginFailedException("Le mot de passe et / ou l'identifiant ou l'email sont incorrect");
        }

        $userInfra = $userInfraEmail == null ? $userInfraIdentifier : $userInfraEmail;
        $user = $this->userMapper->toDomain($userInfra);

        $isPasswordValid = $this->passwordHasher->verify($request->password, $user->getPassword());
        if(!$isPasswordValid)
        {
            throw new LoginFailedException("Le mot de passe et / ou l'identifiant ou l'email sont incorrect");
        }

        return new LoginResponse($user);
    }

}
