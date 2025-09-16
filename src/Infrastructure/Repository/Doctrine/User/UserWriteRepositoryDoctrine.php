<?php

namespace Infrastructure\Repository\Doctrine\User;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Mapper\UserMapper;
use Domain\Repository\User\UserWriteRepository;
use Infrastructure\Entity\Doctrine\Mapper\UserMapperDoctrine;
use Infrastructure\Entity\Doctrine\UserDoctrine;

class UserWriteRepositoryDoctrine extends ServiceEntityRepository implements UserWriteRepository
{
    public function __construct(private EntityManagerInterface $em, private UserMapper $userMapper, ManagerRegistry $registry){
        parent::__construct($registry, UserDoctrine::class);
    }
    public function save($item): void
    {
        $userDoctrine = null;
        if ($item->getId() !== null) {
            $userDoctrine = $this->find($item->getId());
        }
        $userDoctrine = $this->userMapper->toInfra($item, $userDoctrine);

        $this->em->persist($userDoctrine);
        $this->em->flush();
    }
    public function deleteById(int $id)
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(UserDoctrine::class, 'u')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->execute();
    }
    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(UserDoctrine::class, 'user')->getQuery()->execute();
    }

    public function getLastInsertId(): int
    {
        return $this->em->getConnection()->lastInsertId();
    }
}
