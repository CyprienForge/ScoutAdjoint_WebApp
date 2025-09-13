<?php

namespace Infrastructure\Repository\Doctrine\Position;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\Position\PositionReadRepository;
use Infrastructure\Entity\Doctrine\PositionDoctrine;

class PositionReadRepositoryDoctrine extends ServiceEntityRepository implements PositionReadRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, PositionDoctrine::class);
    }

    public function findById(int $id)
    {
        return $this->find($id);
    }
}
