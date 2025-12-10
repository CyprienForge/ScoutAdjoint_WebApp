<?php

namespace Infrastructure\Repository\Doctrine\Player;

use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Exception\ShowDetailsPlayer\PlayerNotFoundException;
use Domain\Mapper\PlayerMapper;
use Domain\Repository\Player\PlayerReadRepository;
use Infrastructure\Entity\Doctrine\PlayerDoctrine;

class PlayerReadRepositoryDoctrine extends ServiceEntityRepository implements PlayerReadRepository
{
    public function __construct(private EntityManagerInterface $em, private PlayerMapper $playerMapper, ManagerRegistry $registry){
        parent::__construct($registry, PlayerDoctrine::class);
    }
    public function findPaginated(int $limit, int $offset, ?string $firstName = null, ?string $lastName = null, ?DateTime $startBirthDate = null, ?DateTime $endBirthDate = null, ?array $positions = null, ?string $team = null)
    {
        $queryBuilder = $this->createQueryBuilder('p');

        if($firstName){
            $queryBuilder->andWhere('LOWER(p.firstName) like LOWER(:firstName)')->setParameter('firstName', '%'.strtolower($firstName).'%');
        }
        if($lastName){
            $queryBuilder->andWhere('LOWER(p.lastName) like LOWER(:lastName)')->setParameter('lastName', '%'.strtolower($lastName).'%');
        }
        if ($startBirthDate) {
            $queryBuilder->andWhere('p.birthDate >= :startBirthDate')->setParameter('startBirthDate', $startBirthDate->format('Y-m-d'));
        }
        if ($endBirthDate) {
            $queryBuilder->andWhere('p.birthDate <= :endBirthDate')->setParameter('endBirthDate', $endBirthDate->format('Y-m-d'));
        }
        if($positions) {
            $queryBuilder->join('p.placementDoctrines', 'plac')
                ->andWhere('plac.position IN (:positions)')
                ->setParameter('positions', $positions);
        }
        if($team){
            $queryBuilder->join('p.team', 't')
                ->andWhere('LOWER(t.name) like LOWER(:team)')
                ->setParameter('team', '%'.strtolower($team).'%');
        }

        $result = $queryBuilder->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

        $players = [];
        foreach($result as $player)
        {
            $players[] = $this->playerMapper->toDomain($player);
        }

        return $players;
    }

    public function findById(int $id)
    {
        $playerDoctrine = $this->find($id);
        if(!$playerDoctrine){
            throw new PlayerNotFoundException("Player with ID : " .  $id . " doesn't exists !");
        }
        return $this->playerMapper->toDomain($playerDoctrine);
    }

    public function findAll(): array
    {
        return $this->findAll();
    }
}
