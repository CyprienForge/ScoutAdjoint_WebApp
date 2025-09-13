<?php

namespace Domain\Repository\Note;

use Domain\Repository\ReadRepository;

interface NoteReadRepository extends ReadRepository
{
    public function findByParticipation(int $idParticipation) : array;
}
