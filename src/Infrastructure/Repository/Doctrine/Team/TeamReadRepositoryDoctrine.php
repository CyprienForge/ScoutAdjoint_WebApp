<?php

namespace Infrastructure\Repository\Doctrine\Team;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Mapper\TeamMapper;
use Domain\Repository\Team\TeamReadRepository;
use Infrastructure\Entity\Doctrine\TeamDoctrine;

class TeamReadRepositoryDoctrine extends ServiceEntityRepository implements TeamReadRepository
{
    public function __construct(private EntityManagerInterface $em, private TeamMapper $teamMapper, ManagerRegistry $registry){
        parent::__construct($registry, TeamDoctrine::class);
    }

    public function findAll() : array
    {
        $teamsDoctrine = parent::findAll();
        $teams = [];

        foreach($teamsDoctrine as $team)
        {
            $teams[] = $this->teamMapper->toDomain($team);
        }

        return $teams;
    }

    public function findById(int $id)
    {
        $teamDoctrine = $this->find($id);
        return $this->teamMapper->toDomain($teamDoctrine);
    }
}
