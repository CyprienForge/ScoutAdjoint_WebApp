<?php

namespace Infrastructure\Repository\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\MatchRepository;
use Infrastructure\Entity\Doctrine\MatchDoctrine;

class MatchRepositoryDoctrine extends ServiceEntityRepository implements MatchRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, MatchDoctrine::class);
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
        // TODO: Implement findById() method.
    }

    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(MatchDoctrine::class, 'match')->getQuery()->execute();
    }

    public function findByIdentificationCode(string $identificationCode)
    {
        return $this->findOneBy(['identificationCode' => $identificationCode]);
    }
}
