<?php

namespace Infrastructure\Repository\Doctrine\Team;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Mapper\TeamMapper;
use Domain\Repository\Team\TeamWriteRepository;
use Infrastructure\Entity\Doctrine\TeamDoctrine;

class TeamWriteRepositoryDoctrine extends ServiceEntityRepository implements TeamWriteRepository
{
    public function __construct(private EntityManagerInterface $em, private TeamMapper $teamMapper, ManagerRegistry $registry){
        parent::__construct($registry, TeamDoctrine::class);
    }

    public function save($item): void
    {
        $teamDoctrine = null;
        if ($item->getId() !== null) {
            $teamDoctrine = $this->find($item->getId());
        }

        $teamDoctrine = $this->teamMapper->toInfra($item, $teamDoctrine);
        $this->em->persist($teamDoctrine);
        $this->em->flush();
    }

    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(TeamDoctrine::class, 'team')->getQuery()->execute();
    }
}
