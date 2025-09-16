<?php

namespace Infrastructure\Repository\Doctrine\User;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Mapper\UserMapper;
use Domain\Repository\User\UserReadRepository;
use Infrastructure\Entity\Doctrine\UserDoctrine;

class UserReadRepositoryDoctrine extends ServiceEntityRepository implements UserReadRepository
{
    public function __construct(private EntityManagerInterface $em, private UserMapper $userMapper, ManagerRegistry $registry){
        parent::__construct($registry, UserDoctrine::class);
    }

    public function findAll(): array
    {
        $usersDoctrine = parent::findAll();
        $users = [];

        foreach($usersDoctrine as $user)
        {
            $users[] = $this->userMapper->toDomain($user);
        }

        return $users;
    }

    public function findByIdentifier(string $identifier)
    {
        $userDoctrine = $this->findOneBy(['identifier' => $identifier]);
        return $userDoctrine == null ? null : $this->userMapper->toDomain($userDoctrine);
    }

    public function findByEmail(string $email)
    {
        $userDoctrine = $this->findOneBy(['email' => $email]);
        return $userDoctrine == null ? null : $this->userMapper->toDomain($userDoctrine);
    }

    public function findById(int $id)
    {
       $userDoctrine = $this->find($id);
       return $this->userMapper->toDomain($userDoctrine);
    }
}
