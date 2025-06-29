<?php

namespace Infrastructure\Repository\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\ParticipationRepository;
use Infrastructure\Entity\Doctrine\ParticipationDoctrine;

class ParticipationRepositoryDoctrine extends ServiceEntityRepository implements ParticipationRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, ParticipationDoctrine::class);
    }

    public function save($item): void
    {
        $this->em->persist($item);
        $this->em->flush();
    }

    public function findById(int $id)
    {
        // TODO: Implement findById() method.
    }

    public function findByIdPlayer(int $idPlayer)
    {
        return $this->findBy(['player' => $idPlayer]);
    }

    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(ParticipationDoctrine::class, 'participation')->getQuery()->execute();
    }

    public function findByIdentificationCode(string $identificationCode)
    {
        // TODO: Implement findByIdentificationCode() method.
    }
}
