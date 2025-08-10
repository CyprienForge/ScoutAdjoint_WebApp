<?php

namespace Domain\ViewModel\Entity;

class NoteViewModel
{
    public function __construct(
        public string $idPlayer,
        public string $firstName,
        public string $lastName,
        public int $numero,
        public array $notes,
        public string $birthYear
    ){}
}
