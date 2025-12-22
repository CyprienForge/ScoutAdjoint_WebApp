<?php

namespace Infrastructure\Json\Dto;

use Domain\Entity\User;

class UserJsonDto
{

    public int $id;
    public string $email;
    public string $identifier;
    public array $roles;

    public function toDto(User $user) : UserJsonDto
    {
        $this->id = $user->getId();
        $this->email = $user->getEmail();
        $this->identifier = $user->getIdentifier();
        $this->roles = $user->getRoles();

        return $this;
    }
}
