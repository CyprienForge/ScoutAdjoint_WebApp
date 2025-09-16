<?php

namespace Infrastructure\Repository\Doctrine\Championship;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Entity\Championship;
use Domain\Mapper\ChampionshipMapper;
use Domain\Repository\Championship\ChampionshipReadRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Infrastructure\Entity\Doctrine\ChampionshipDoctrine;

class ChampionshipReadRepositoryDoctrine extends ServiceEntityRepository implements ChampionshipReadRepository
{
    public function __construct(private EntityManagerInterface $em, private ChampionshipMapper $championshipMapper, ManagerRegistry $registry){
        parent::__construct($registry, ChampionshipDoctrine::class);
    }

    public function findAll(): array
    {
        $championshipsDoctrine = parent::findAll();

        $championships = [];
        foreach($championshipsDoctrine as $championship)
        {
            $championships[] = $this->championshipMapper->toDomain($championship);
        }
        return $championships;
    }

    public function findById(int $id) : Championship
    {
        $championshipDoctrine = $this->find($id);
        return $this->championshipMapper->toDomain($championshipDoctrine);
    }
}
