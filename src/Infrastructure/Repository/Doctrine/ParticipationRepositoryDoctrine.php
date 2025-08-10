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

    public function findByMatch(int $idMatch): array
    {
        return $this->findBy(['match' => $idMatch]);
    }

    public function findByMatchAndTeam(int $idMatch, int $idTeam): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('p')
            ->from(ParticipationDoctrine::class, 'p')
            ->where('p.match = :match')
            ->andWhere('p.team = :team')
            ->setParameter('match', $idMatch)
            ->setParameter('team', $idTeam)
            ->orderBy('p.numero', 'ASC');

        return $qb->getQuery()->getResult();
    }
}
