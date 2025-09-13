<?php

namespace Infrastructure\Repository\Doctrine\MatchInfos;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\MatchInfos\MatchInfosWriteRepository;
use Infrastructure\Entity\Doctrine\MatchInfosDoctrine;

class MatchInfosWriteRepositoryDoctrine extends ServiceEntityRepository implements MatchInfosWriteRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, MatchInfosDoctrine::class);
    }
    public function save($item): void
    {
        $this->em->persist($item);
        $this->em->flush();
    }

    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(MatchInfosDoctrine::class, 'match_infos')->getQuery()->execute();
    }
}
