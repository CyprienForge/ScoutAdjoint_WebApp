<?php

namespace Infrastructure\Entity\Doctrine\Mapper;

use Domain\Entity\User;
use Domain\Mapper\UserMapper;
use Domain\Repository\User\UserReadRepository;
use Infrastructure\Entity\Doctrine\UserDoctrine;

class UserMapperDoctrine implements UserMapper
{
    public function __construct(){}

    public function toDomain($item)
    {
        $user = new User();

        $user->setId($item->getId());
        $user->setEmail($item->getEmail());
        $user->setIdentifier($item->getIdentifier());
        $user->setPassword($item->getPassword());
        $user->setRoles($item->getRoles());

        return $user;
    }

    public function toInfra($item, ?UserDoctrine $existing = null)
    {
        $userDoctrine = $existing ?? new UserDoctrine();

        if($existing){
            $userDoctrine->setId($item->getId());
        }
        $userDoctrine->setEmail($item->getEmail());
        $userDoctrine->setIdentifier($item->getIdentifier());
        $userDoctrine->setPassword($item->getPassword());
        $userDoctrine->setRoles($item->getRoles());

        return $userDoctrine;
    }
}
