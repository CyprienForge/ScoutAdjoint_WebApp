<?php

namespace Infrastructure\Repository\Doctrine\Note;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Mapper\NoteMapper;
use Domain\Repository\Note\NoteReadRepository;
use Infrastructure\Entity\Doctrine\NoteDoctrine;

class NoteReadRepositoryDoctrine extends ServiceEntityRepository implements NoteReadRepository
{
    public function __construct(
        EntityManagerInterface $em,
        ManagerRegistry $registry,
        private NoteMapper $noteMapper
    ){
        parent::__construct($registry, NoteDoctrine::class);
    }
    public function findByParticipation(int $idParticipation) : array
    {
        $notesDoctrine = $this->findBy(['participation' => $idParticipation]);
        $notes = [];

        foreach ($notesDoctrine as $note){
            $notes[] = $this->noteMapper->toDomain($note);
        }

        return $notes;
    }

    public function findById(int $id)
    {
        return $this->find($id);
    }
}
