<?php

namespace Infrastructure\Repository\Doctrine\Participation;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Mapper\ParticipationMapper;
use Domain\Repository\Participation\ParticipationReadRepository;
use Infrastructure\Entity\Doctrine\ParticipationDoctrine;

class ParticipationReadRepositoryDoctrine extends ServiceEntityRepository implements ParticipationReadRepository
{
    public function __construct(private EntityManagerInterface $em, private ParticipationMapper $participationMapper,ManagerRegistry $registry){
        parent::__construct($registry, ParticipationDoctrine::class);
    }
    public function findByMatch(int $idMatch): array
    {
        $participationsDoctrine = $this->findBy(
            ['match' => $idMatch],
            ['numero' => 'ASC']
        );

        $participations = [];
        foreach($participationsDoctrine as $participationDoctrine)
        {
            $participations[] = $this->participationMapper->toDomain($participationDoctrine);
        }

        return $participations;
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

    public function findById(int $id)
    {
        return $this->find($id);
    }

    public function findByPlayer(int $idPlayer)
    {
        return $this->findBy(['player' => $idPlayer]);
    }
}
