<?php

namespace Infrastructure\Repository\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Mapper\MatchInfosMapper;
use Domain\Repository\MatchInfosRepository;
use Infrastructure\Entity\Doctrine\ChampionshipDoctrine;
use Infrastructure\Entity\Doctrine\MatchInfosDoctrine;

class MatchInfosRepositoryDoctrine extends ServiceEntityRepository implements MatchInfosRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, MatchInfosDoctrine::class);
    }
    public function save($item): void
    {
        $this->em->persist($item);
        $this->em->flush();
    }
    public function findByMatch(int $idMatch)
    {
        return $this->findOneBy(['match' => $idMatch]);
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
