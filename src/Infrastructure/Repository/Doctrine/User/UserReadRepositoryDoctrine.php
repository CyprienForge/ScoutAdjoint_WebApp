<?php

namespace Infrastructure\Repository\Doctrine\User;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\User\UserReadRepository;
use Infrastructure\Entity\Doctrine\UserDoctrine;

class UserReadRepositoryDoctrine extends ServiceEntityRepository implements UserReadRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, UserDoctrine::class);
    }
    public function findByIdentifier(string $identifier)
    {
        return $this->findOneBy(['identifier' => $identifier]);
    }

    public function findByEmail(string $email)
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function findById(int $id)
    {
       return $this->find($id);
    }
}
