<?php

namespace Infrastructure\Repository\Doctrine\MatchInfos;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Exception\NotFoundException;
use Domain\Mapper\MatchInfosMapper;
use Domain\Repository\MatchInfos\MatchInfosReadRepository;
use Infrastructure\Entity\Doctrine\MatchInfosDoctrine;

class MatchInfosReadRepositoryDoctrine extends ServiceEntityRepository implements MatchInfosReadRepository
{

    public function __construct(private EntityManagerInterface $em, private MatchInfosMapper $matchInfosMapper, ManagerRegistry $registry){
        parent::__construct($registry, MatchInfosDoctrine::class);
    }

    public function findByMatch(int $idMatch)
    {
        $matchInfosInfra = $this->findOneBy(['match' => $idMatch]);
        if(!$matchInfosInfra){
            throw new NotFoundException("MatchInfos with ID's match : " .  $idMatch . " doesn't exists !");
        }
        return $this->matchInfosMapper->toDomain($matchInfosInfra);
    }

    public function findById(int $id)
    {
        return $this->find($id);
    }
}
