<?php

namespace Domain\Repository;

use Domain\Entity\Note;

/**
 * @implements Repository<Note>
 */
interface NoteRepository extends Repository
{
    public function findByParticipation(int $idParticipation) : array;
}
