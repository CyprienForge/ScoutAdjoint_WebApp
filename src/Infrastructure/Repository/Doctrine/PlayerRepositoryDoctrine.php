<?php

namespace Infrastructure\Repository\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\PlayerRepository;
use Infrastructure\Entity\Doctrine\PlayerDoctrine;

class PlayerRepositoryDoctrine extends ServiceEntityRepository implements PlayerRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, PlayerDoctrine::class);
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
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(PlayerDoctrine::class, 'player')->getQuery()->execute();
    }

    public function findByIdentificationCode(string $identificationCode)
    {
       return $this->findOneBy(['identificationCode' => $identificationCode]);
    }
}
