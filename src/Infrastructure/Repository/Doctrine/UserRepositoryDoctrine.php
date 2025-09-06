<?php

namespace Infrastructure\Repository\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\UserRepository;
use Infrastructure\Entity\Doctrine\UserDoctrine;

class UserRepositoryDoctrine extends ServiceEntityRepository implements UserRepository
{

    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, UserDoctrine::class);
    }

    public function save($item): void
    {
        $this->em->persist($item);
        $this->em->flush();
    }

    public function findAll(): array
    {
        return parent::findAll();
    }

    public function findById(int $id)
    {
        return $this->find($id);
    }

    public function deleteAll()
    {
        // TODO: Implement deleteAll() method.
    }

    public function findByIdentificationCode(string $identificationCode)
    {
        // TODO: Implement findByIdentificationCode() method.
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

    public function findByIdentifier(string $identifier)
    {
        return $this->findOneBy(['identifier' => $identifier]);
    }

    public function findByEmail(string $email)
    {
        return $this->findOneBy(['email' => $email]);
    }
}
