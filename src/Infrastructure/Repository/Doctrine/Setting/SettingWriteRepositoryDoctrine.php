<?php

namespace Infrastructure\Repository\Doctrine\Setting;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\Setting\SettingWriteRepository;
use Infrastructure\Entity\Doctrine\SettingDoctrine;

class SettingWriteRepositoryDoctrine extends ServiceEntityRepository implements SettingWriteRepository
{

    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, SettingDoctrine::class);
    }

    public function save($item): void
    {
        $this->em->persist($item);
        $this->em->flush();
    }

    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(SettingDoctrine::class, 'setting')->getQuery()->execute();
    }
}
