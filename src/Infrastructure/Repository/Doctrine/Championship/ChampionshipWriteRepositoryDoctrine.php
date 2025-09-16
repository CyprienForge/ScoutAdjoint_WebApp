<?php

namespace Infrastructure\Repository\Doctrine\Championship;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Entity\Championship;
use Domain\Repository\Championship\ChampionshipWriteRepository;
use Infrastructure\Entity\Doctrine\ChampionshipDoctrine;

class ChampionshipWriteRepositoryDoctrine extends ServiceEntityRepository implements ChampionshipWriteRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, ChampionshipDoctrine::class);
    }

    public function save($item): void
    {
        $this->em->persist($item);
        $this->em->flush();
    }

    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(ChampionshipDoctrine::class, 'championship')->getQuery()->execute();
    }
}
