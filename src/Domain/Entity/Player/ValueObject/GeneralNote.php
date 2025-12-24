<?php

namespace Domain\Entity\Player\ValueObject;

class GeneralNote
{

    public function __construct(
        private ?string $note = "",
    ){
        $this->note = $this->note == null ? "" : $this->note;
    }

    public function value(): string
    {
        return $this->note;
    }

    public function withNote(string $note) : GeneralNote
    {
        return new GeneralNote($note);
    }
}
