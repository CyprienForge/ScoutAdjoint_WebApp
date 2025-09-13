<?php

namespace Infrastructure\Repository\Doctrine\Placement;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\Placement\PlacementReadRepository;
use Infrastructure\Entity\Doctrine\PlacementDoctrine;

class PlacementReadRepositoryDoctrine extends ServiceEntityRepository implements PlacementReadRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, PlacementDoctrine::class);
    }

    public function findByPlayer(int $idPlayer): array
    {
        return $this->createQueryBuilder('pl')
            ->join('pl.position', 'pos')
            ->where('pl.player = :idPlayer')
            ->setParameter('idPlayer', $idPlayer)
            ->getQuery()
            ->getResult();
    }

    public function findById(int $id)
    {
        return $this->find($id);
    }
}
