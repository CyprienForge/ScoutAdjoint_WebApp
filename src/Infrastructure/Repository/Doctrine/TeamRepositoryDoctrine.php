<?php

namespace Infrastructure\Repository\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\TeamRepository;
use Infrastructure\Entity\Doctrine\TeamDoctrine;

class TeamRepositoryDoctrine extends ServiceEntityRepository implements TeamRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, TeamDoctrine::class);
    }
    public function save($item): void
    {
        $this->em->persist($item);
        $this->em->flush();
    }

    public function findAll(): array
    {
        return parent::findAll();
    }

    public function findById(int $id)
    {
        return $this->find($id);
    }

    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(TeamDoctrine::class, 'team')->getQuery()->execute();
    }

    public function findByIdentificationCode(string $identificationCode)
    {
        return $this->findOneBy(['identificationCode' => $identificationCode]);
    }
}
