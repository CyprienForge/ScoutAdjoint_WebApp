<?php

namespace Infrastructure\Repository\Doctrine\Match;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Mapper\MatchMapper;
use Domain\Repository\Match\MatchReadRepository;
use Infrastructure\Entity\Doctrine\MatchDoctrine;

class MatchReadRepositoryDoctrine extends ServiceEntityRepository implements MatchReadRepository
{
    public function __construct(private EntityManagerInterface $em, private MatchMapper $matchMapper, ManagerRegistry $registry){
        parent::__construct($registry, MatchDoctrine::class);
    }

    public function findAll(): array
    {
        $matchesInfra = parent::findAll();
        $matches = [];

        foreach ($matchesInfra as $matchInfra) {
            $matches[] = $this->matchMapper->toDomain($matchInfra);
        }

        return $matches;
    }

    public function findById(int $id)
    {
        $matchInfra = $this->find($id);
        return $this->matchMapper->toDomain($matchInfra);
    }
}
