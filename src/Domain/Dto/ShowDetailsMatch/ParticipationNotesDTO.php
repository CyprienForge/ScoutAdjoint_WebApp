<?php

namespace Domain\Dto\ShowDetailsMatch;

use Domain\Entity\Participation;

class ParticipationNotesDTO
{

    public function __construct(
        private Participation $participation,
        private array $notes
    ){}

    public function getParticipation(): Participation
    {
        return $this->participation;
    }

    public function getNotes(): array
    {
        return $this->notes;
    }
}
