<?php

namespace Infrastructure\Repository\Doctrine\Participation;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Mapper\ParticipationMapper;
use Domain\Repository\Participation\ParticipationWriteRepository;
use Infrastructure\Entity\Doctrine\ParticipationDoctrine;

class ParticipationWriteRepositoryDoctrine extends ServiceEntityRepository implements ParticipationWriteRepository
{
    public function __construct(private EntityManagerInterface $em, private ParticipationMapper $participationMapper,ManagerRegistry $registry){
        parent::__construct($registry, ParticipationDoctrine::class);
    }

    public function save($item): void
    {
        $this->em->persist($item);
        $this->em->flush();
    }

    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(ParticipationDoctrine::class, 'participation')->getQuery()->execute();
    }
}
