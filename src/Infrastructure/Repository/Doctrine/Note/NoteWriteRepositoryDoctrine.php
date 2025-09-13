<?php

namespace Infrastructure\Repository\Doctrine\Note;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Mapper\NoteMapper;
use Domain\Repository\Note\NoteWriteRepository;
use Infrastructure\Entity\Doctrine\NoteDoctrine;

class NoteWriteRepositoryDoctrine extends ServiceEntityRepository implements NoteWriteRepository
{
    public function __construct(
        EntityManagerInterface $em,
        ManagerRegistry $registry,
        private NoteMapper $noteMapper
    ){
        parent::__construct($registry, NoteDoctrine::class);
    }

    public function save($item): void
    {
        $this->em->persist($item);
        $this->em->flush();
    }

    public function deleteAll()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->delete(NoteDoctrine::class, 'note')->getQuery()->execute();
    }
}
