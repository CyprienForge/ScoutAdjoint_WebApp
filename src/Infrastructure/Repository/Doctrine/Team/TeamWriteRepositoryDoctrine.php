<?php

namespace Infrastructure\Repository\Doctrine\Team;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\Team\TeamWriteRepository;
use Infrastructure\Entity\Doctrine\TeamDoctrine;

class TeamWriteRepositoryDoctrine extends ServiceEntityRepository implements TeamWriteRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, TeamDoctrine::class);
    }

    public function save($item): void
    {
        $this->em->persist($item);
        $this->em->flush();
    }

    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(TeamDoctrine::class, 'team')->getQuery()->execute();
    }
}
