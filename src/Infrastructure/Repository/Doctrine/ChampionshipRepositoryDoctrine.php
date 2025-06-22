<?php

namespace Infrastructure\Repository\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\ChampionshipRepository;
use Infrastructure\Entity\Doctrine\ChampionshipDoctrine;

class ChampionshipRepositoryDoctrine extends ServiceEntityRepository implements ChampionshipRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, ChampionshipDoctrine::class);
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
        $queryBuilder->delete(ChampionshipDoctrine::class, 'championship')->getQuery()->execute();
    }

    public function findByName(string $name): ?ChampionshipDoctrine
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function findByIdentificationCode(string $identificationCode)
    {
        return $this->findOneBy(['identificationCode' => $identificationCode]);
    }
}
