<?php

namespace Infrastructure\Repository\Doctrine\Position;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Mapper\PositionMapper;
use Domain\Repository\Position\PositionWriteRepository;
use Infrastructure\Entity\Doctrine\PositionDoctrine;

class PositionWriteRepositoryDoctrine extends ServiceEntityRepository implements PositionWriteRepository
{
    public function __construct(private EntityManagerInterface $em, private PositionMapper $positionMapper, ManagerRegistry $registry){
        parent::__construct($registry, PositionDoctrine::class);
    }
    public function save($item): void
    {
        $positionDoctrine = null;
        if ($item->getId() !== null) {
            $positionDoctrine = $this->find($item->getId());
        }

        $positionDoctrine = $this->positionMapper->toInfra($item, $positionDoctrine);
        $this->em->persist($positionDoctrine);
        $this->em->flush();
    }

    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(PositionDoctrine::class, 'position')->getQuery()->execute();
    }
}
