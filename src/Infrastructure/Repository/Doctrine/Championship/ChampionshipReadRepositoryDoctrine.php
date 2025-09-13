<?php

namespace Infrastructure\Repository\Doctrine\Championship;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\Championship\ChampionshipReadRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Infrastructure\Entity\Doctrine\ChampionshipDoctrine;

class ChampionshipReadRepositoryDoctrine extends ServiceEntityRepository implements ChampionshipReadRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, ChampionshipDoctrine::class);
    }

    public function findAll(): array
    {
        return parent::findAll();
    }

    public function findById(int $id)
    {
        return $this->find($id);
    }
}
