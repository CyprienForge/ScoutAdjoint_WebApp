<?php

namespace Infrastructure\Repository\Doctrine\Match;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\Match\MatchWriteRepository;
use Infrastructure\Entity\Doctrine\MatchDoctrine;

class MatchWriteRepositoryDoctrine extends ServiceEntityRepository implements MatchWriteRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, MatchDoctrine::class);
    }

    public function save($item): void
    {
        $this->em->persist($item);
        $this->em->flush();
    }

    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(MatchDoctrine::class, 'match')->getQuery()->execute();
    }
}
