<?php

namespace Infrastructure\Repository\Doctrine\Placement;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Mapper\PlacementMapper;
use Domain\Repository\Placement\PlacementWriteRepository;
use Infrastructure\Entity\Doctrine\PlacementDoctrine;

class PlacementWriteRepositoryDoctrine extends ServiceEntityRepository implements PlacementWriteRepository
{
    public function __construct(private EntityManagerInterface $em, private PlacementMapper $placementMapper, ManagerRegistry $registry){
        parent::__construct($registry, PlacementDoctrine::class);
    }
    public function save($item): void
    {
        $placementDoctrine = null;
        if ($item->getId() !== null) {
            $placementDoctrine = $this->find($item->getId());
        }

        $placementDoctrine = $this->placementMapper->toInfra($item, $placementDoctrine);
        $this->em->persist($placementDoctrine);
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
