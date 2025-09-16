<?php

namespace Infrastructure\Repository\Doctrine\Match;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Mapper\MatchMapper;
use Domain\Repository\Match\MatchWriteRepository;
use Infrastructure\Entity\Doctrine\MatchDoctrine;

class MatchWriteRepositoryDoctrine extends ServiceEntityRepository implements MatchWriteRepository
{
    public function __construct(private EntityManagerInterface $em, private MatchMapper $matchMapper, ManagerRegistry $registry){
        parent::__construct($registry, MatchDoctrine::class);
    }

    public function save($item): void
    {
        $matchDoctrine = null;
        if ($item->getId() !== null) {
            $matchDoctrine = $this->find($item->getId());
        }

        $matchDoctrine = $this->matchMapper->toInfra($item, $matchDoctrine);
        $this->em->persist($matchDoctrine);
        $this->em->flush();
    }

    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(MatchDoctrine::class, 'match')->getQuery()->execute();
    }
}
