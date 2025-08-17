<?php

namespace Infrastructure\Repository\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\PositionRepository;
use Infrastructure\Entity\Doctrine\PositionDoctrine;

class PositionRepositoryDoctrine extends ServiceEntityRepository implements PositionRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, PositionDoctrine::class);
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
        // TODO: Implement findById() method.
    }

    public function deleteAll()
    {
        // TODO: Implement deleteAll() method.
    }

    public function findByIdentificationCode(string $identificationCode)
    {
        // TODO: Implement findByIdentificationCode() method.
    }
}
