<?php

namespace Infrastructure\Repository\Doctrine\Match;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\Match\MatchReadRepository;
use Infrastructure\Entity\Doctrine\MatchDoctrine;

class MatchReadRepositoryDoctrine extends ServiceEntityRepository implements MatchReadRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, MatchDoctrine::class);
    }

    public function findById(int $id)
    {
        return $this->find($id);
    }
}
