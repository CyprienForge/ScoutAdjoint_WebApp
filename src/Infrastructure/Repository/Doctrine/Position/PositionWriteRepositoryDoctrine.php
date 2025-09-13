<?php

namespace Infrastructure\Repository\Doctrine\Position;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\Position\PositionWriteRepository;
use Infrastructure\Entity\Doctrine\PositionDoctrine;

class PositionWriteRepositoryDoctrine extends ServiceEntityRepository implements PositionWriteRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, PositionDoctrine::class);
    }
    public function save($item): void
    {
        $this->em->persist($item);
        $this->em->flush();
    }

    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(PositionDoctrine::class, 'position')->getQuery()->execute();
    }
}
