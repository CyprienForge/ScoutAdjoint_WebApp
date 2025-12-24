<?php

namespace Infrastructure\Repository\Doctrine\Player;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Mapper\PlayerMapper;
use Domain\Repository\Player\PlayerWriteRepository;
use Infrastructure\Entity\Doctrine\PlacementDoctrine;
use Infrastructure\Entity\Doctrine\PlayerDoctrine;

class PlayerWriteRepositoryDoctrine extends ServiceEntityRepository implements PlayerWriteRepository
{
    public function __construct(private EntityManagerInterface $em, private PlayerMapper $playerMapper, ManagerRegistry $registry){
        parent::__construct($registry, PlayerDoctrine::class);
    }

    public function getLastInsertId() : int
    {
        return $this->em->getConnection()->lastInsertId();
    }
    public function save($item) : void
    {
        $playerDoctrine = null;
        if ($item->getId()->value() !== null) {
            $playerDoctrine = $this->find($item->getId()->value());
        }

        $playerDoctrine = $this->playerMapper->toInfra($item, $playerDoctrine);

        $this->em->persist($playerDoctrine);
        $this->em->flush();
    }

    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(PlayerDoctrine::class, 'player')->getQuery()->execute();
    }

    public function deleteById(int $idPlayer): void
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(PlacementDoctrine::class, 'placement')
                     ->where('placement.player = :idPlayer')
                     ->setParameter('idPlayer', $idPlayer)
                     ->getQuery()
                     ->execute();

        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(PlayerDoctrine::class, 'u')
            ->where('u.id = :id')
            ->setParameter('id', $idPlayer)
            ->getQuery()
            ->execute();
    }
}
