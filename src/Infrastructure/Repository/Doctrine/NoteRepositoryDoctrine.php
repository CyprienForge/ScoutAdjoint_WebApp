<?php

namespace Infrastructure\Repository\Doctrine;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Mapper\NoteMapper;
use Domain\Repository\NoteRepository;
use Infrastructure\Entity\Doctrine\NoteDoctrine;

class NoteRepositoryDoctrine extends ServiceEntityRepository implements NoteRepository
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
        // TODO: Implement save() method.
    }

    public function findById(int $id)
    {
        // TODO: Implement findById() method.
    }

    public function deleteAll()
    {
        // TODO: Implement deleteAll() method.
    }

    public function findByIdentificationCode(string $identificationCode)
    {
        // TODO: Implement findByIdentificationCode() method.
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
}
