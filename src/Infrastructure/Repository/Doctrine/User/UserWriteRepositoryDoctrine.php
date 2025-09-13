<?php

namespace Infrastructure\Repository\Doctrine\User;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\User\UserWriteRepository;
use Infrastructure\Entity\Doctrine\UserDoctrine;

class UserWriteRepositoryDoctrine extends ServiceEntityRepository implements UserWriteRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, UserDoctrine::class);
    }
    public function deleteById(int $id)
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(UserDoctrine::class, 'u')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->execute();
    }
    public function save($item): void
    {
        $this->em->persist($item);
        $this->em->flush();
    }
    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(UserDoctrine::class, 'user')->getQuery()->execute();    }
}
