<?php

namespace Infrastructure\Service\Symfony;

use Domain\Entity\User;
use Domain\Service\RegisterUser\PasswordHasher;
use Infrastructure\Entity\Doctrine\UserDoctrine;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SymfonyPasswordHasher implements PasswordHasher
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher){}

    public function hash(string $password): string
    {
        return $this->userPasswordHasher->hashPassword(new UserDoctrine(), $password);
    }

    public function verify(string $password, string $passwordHash): bool
    {
        $tmpUser = new UserDoctrine();
        $tmpUser->setPassword($passwordHash);

        return $this->userPasswordHasher->isPasswordValid($tmpUser, $password);
    }
}
