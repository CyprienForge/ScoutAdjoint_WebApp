<?php

namespace Infrastructure\Repository\Doctrine\Placement;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\Placement\PlacementWriteRepository;
use Infrastructure\Entity\Doctrine\PlacementDoctrine;

class PlacementWriteRepositoryDoctrine extends ServiceEntityRepository implements PlacementWriteRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, PlacementDoctrine::class);
    }
    public function save($item): void
    {
        $this->em->persist($item);
        $this->em->flush();
    }
    public function deleteAllByPlayer(int $idPlayer): int
    {
        return $this->createQueryBuilder('p')
            ->delete()
            ->where('p.player = :idPlayer')
            ->setParameter('idPlayer', $idPlayer)
            ->getQuery()
            ->execute();
    }

    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(PlacementDoctrine::class, 'placement')->getQuery()->execute();
    }
}
