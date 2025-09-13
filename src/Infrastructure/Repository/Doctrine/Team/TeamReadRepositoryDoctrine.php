<?php

namespace Infrastructure\Repository\Doctrine\Team;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\Team\TeamReadRepository;
use Infrastructure\Entity\Doctrine\TeamDoctrine;

class TeamReadRepositoryDoctrine extends ServiceEntityRepository implements TeamReadRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, TeamDoctrine::class);
    }

    public function findById(int $id)
    {
        return $this->find($id);
    }
}
