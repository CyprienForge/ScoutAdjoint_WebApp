<?php

namespace Infrastructure\Repository\Doctrine\Setting;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\Setting\SettingReadRepository;
use Infrastructure\Entity\Doctrine\SettingDoctrine;

class SettingReadRepositoryDoctrine extends ServiceEntityRepository implements SettingReadRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry){
        parent::__construct($registry, SettingDoctrine::class);
    }

    public function findById(int $id)
    {
        return $this->find($id);
    }
}
