<?php

namespace Infrastructure\Repository\Doctrine\Placement;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Mapper\PlacementMapper;
use Domain\Mapper\PositionMapper;
use Domain\Repository\Placement\PlacementReadRepository;
use Infrastructure\Entity\Doctrine\PlacementDoctrine;

class PlacementReadRepositoryDoctrine extends ServiceEntityRepository implements PlacementReadRepository
{
    public function __construct(private EntityManagerInterface $em, private PositionMapper $positionMapper, ManagerRegistry $registry){
        parent::__construct($registry, PlacementDoctrine::class);
    }

    public function findByPlayer(int $idPlayer): array
    {
        $placementsDoctrine = $this->createQueryBuilder('pl')
            ->join('pl.position', 'pos')
            ->where('pl.player = :idPlayer')
            ->setParameter('idPlayer', $idPlayer)
            ->getQuery()
            ->getResult();

        $positions = [];
        foreach($placementsDoctrine as $placement)
        {
            $positions[] = $this->positionMapper->toDomain($placement->getPosition());
        }

        return $positions;
    }

    public function findById(int $id)
    {
        $placementDoctrine = $this->find($id);
        return $this->placementMapper->toDomain($placementDoctrine);
    }
}
