<?php

namespace Domain\Validator\RegisterUser;

use Domain\Exception\RegisterUser\InvalidEmailException;
use Domain\Exception\RegisterUser\InvalidIdentifierException;
use Domain\Exception\RegisterUser\InvalidPasswordDomainException;
use Symfony\Component\PasswordHasher\Exception\InvalidPasswordException;

class UserValidator
{
    private const MIN_IDENTIFIER_LENGTH = 5;

    public function validate(string $identifier, string $email, string $password)
    {
        $this->validateIdentifier($identifier);
        $this->validateEmail($email);
        $this->validatePassword($password);
    }

    public function validateIdentifier(string $identifier): void
    {
        if(strlen($identifier) < self::MIN_IDENTIFIER_LENGTH){
            $min_indentifier_length = self::MIN_IDENTIFIER_LENGTH;
            throw new InvalidIdentifierException("{$identifier} est trop court (minimum {$min_indentifier_length} caractères)");
        }
    }

    public function validateEmail(string $email): void
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new InvalidEmailException("Email ({$email}) incorrect");
        }
    }

    public function validatePassword(string $password): void
    {
        if(strlen($password) < 8){
            throw new InvalidPasswordDomainException("Le mot de passe entré est trop court ! (8 caractères minimum)");
        }

        if (preg_match_all('/\d/', $password) < 2) {
            throw new InvalidPasswordDomainException("Le mot de passe doit contenir au moins 2 chiffres et un caractère spécial.");
        }

        if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
            throw new InvalidPasswordDomainException("Le mot de passe doit contenir au moins 2 chiffres et un caractère spécial.");
        }
    }
}
