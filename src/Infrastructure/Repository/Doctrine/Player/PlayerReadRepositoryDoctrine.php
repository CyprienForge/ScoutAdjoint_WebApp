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
    public function findPaginated(
        int $limit,
        int $offset,
        ?string $firstName = null,
        ?string $lastName = null,
        ?DateTime $startBirthDate = null,
        ?DateTime $endBirthDate = null,
        ?bool $isOr = false,
        ?array $positions = null,
        ?string $team = null
    ) {
        $qb = $this->createQueryBuilder('p');
        $expr = $qb->expr();

        $joins = [
            'team' => false,
            'positions' => false,
        ];

        if ($startBirthDate) {
            $qb->andWhere('p.birthDate >= :startBirthDate')
                ->setParameter('startBirthDate', $startBirthDate->format('Y-m-d'));
        }

        if ($endBirthDate) {
            $qb->andWhere('p.birthDate <= :endBirthDate')
                ->setParameter('endBirthDate', $endBirthDate->format('Y-m-d'));
        }

        if ($positions) {
            $joins['positions'] = true;
            $qb->join('p.placementDoctrines', 'plac')
                ->andWhere('plac.position IN (:positions)')
                ->setParameter('positions', $positions);
        }

        $orFilters = [];
        $andFilters = [];

        if ($firstName) {
            $andFilters[] = 'LOWER(p.firstName) LIKE :firstName';
            $orFilters[]  = 'LOWER(p.firstName) LIKE :firstName';
            $qb->setParameter('firstName', '%'.strtolower($firstName).'%');
        }

        if ($lastName) {
            $andFilters[] = 'LOWER(p.lastName) LIKE :lastName';
            $orFilters[]  = 'LOWER(p.lastName) LIKE :lastName';
            $qb->setParameter('lastName', '%'.strtolower($lastName).'%');
        }

        if ($team) {
            $joins['team'] = true;
            $orFilters[]   = 'LOWER(t.name) LIKE :team';
            $andFilters[]  = 'LOWER(t.name) LIKE :team';
            $qb->setParameter('team', '%'.strtolower($team).'%');
        }

        if ($joins['team']) {
            $qb->join('p.team', 't');
        }

        if ($isOr) {
            if (!empty($orFilters)) {
                $qb->andWhere($expr->orX(...$orFilters));
            }
        } else {
            foreach ($andFilters as $condition) {
                $qb->andWhere($condition);
            }
        }

        $result = $qb->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

        return array_map(fn($p) => $this->playerMapper->toDomain($p), $result);
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
