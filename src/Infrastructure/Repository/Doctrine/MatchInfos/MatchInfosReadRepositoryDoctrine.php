<?php

namespace Infrastructure\Repository\Doctrine\MatchInfos;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\MatchInfos\MatchInfosReadRepository;
use Infrastructure\Entity\Doctrine\MatchInfosDoctrine;

class MatchInfosReadRepositoryDoctrine extends ServiceEntityRepository implements MatchInfosReadRepository
{

    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, MatchInfosDoctrine::class);
    }

    public function findByMatch(int $idMatch)
    {
        return $this->findOneBy(['match' => $idMatch]);
    }

    public function findById(int $id)
    {
        return $this->find($id);
    }
}
