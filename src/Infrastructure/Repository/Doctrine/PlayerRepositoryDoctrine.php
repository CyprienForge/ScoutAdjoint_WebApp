<?php

namespace Infrastructure\Repository\Doctrine;

use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\PlayerRepository;
use Infrastructure\Entity\Doctrine\PlayerDoctrine;
use function Symfony\Component\Translation\t;

class PlayerRepositoryDoctrine extends ServiceEntityRepository implements PlayerRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, PlayerDoctrine::class);
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
        $queryBuilder->delete(PlayerDoctrine::class, 'player')->getQuery()->execute();
    }

    public function findByIdentificationCode(string $identificationCode)
    {
       return $this->findOneBy(['identificationCode' => $identificationCode]);
    }

    public function findPaginated(int $limit, int $offset, ?string $firstName = null, ?string $lastName = null, ?DateTime $startBirthDate = null, ?DateTime $endBirthDate = null)
    {
        $queryBuilder = $this->createQueryBuilder('p');

        if($firstName){
            $queryBuilder->andWhere('p.firstName like :firstName')->setParameter('firstName', '%'.$firstName.'%');
        }
        if($lastName){
            $queryBuilder->andWhere('p.lastName like :lastName')->setParameter('lastName', '%'.$lastName.'%');
        }
        if ($startBirthDate) {
            $queryBuilder->andWhere('p.birthDate >= :startBirthDate')->setParameter('startBirthDate', $startBirthDate->format('Y-m-d'));
        }
        if ($endBirthDate) {
            $queryBuilder->andWhere('p.birthDate <= :endBirthDate')->setParameter('endBirthDate', $endBirthDate->format('Y-m-d'));
        }

        return $queryBuilder->setFirstResult($offset)
                    ->setMaxResults($limit)
                    ->getQuery()
                    ->getResult();
    }
}
