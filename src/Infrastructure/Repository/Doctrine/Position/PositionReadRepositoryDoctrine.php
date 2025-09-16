<?php

namespace Infrastructure\Repository\Doctrine\Position;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Mapper\PositionMapper;
use Domain\Repository\Position\PositionReadRepository;
use Infrastructure\Entity\Doctrine\PositionDoctrine;

class PositionReadRepositoryDoctrine extends ServiceEntityRepository implements PositionReadRepository
{
    public function __construct(private EntityManagerInterface $em, private PositionMapper $positionMapper, ManagerRegistry $registry){
        parent::__construct($registry, PositionDoctrine::class);
    }

    public function findAll() : array
    {
        $positionsInfra = parent::findAll();
        $positions = [];

        foreach($positionsInfra as $position)
        {
            $positions[] = $this->positionMapper->toDomain($position);
        }

        return $positions;
    }

    public function findById(int $id)
    {
        $positionInfra = $this->find($id);
        return $this->positionMapper->toDomain($positionInfra);
    }
}
