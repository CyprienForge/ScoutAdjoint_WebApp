<?php

namespace Infrastructure\Json\Dto;

use Domain\Dto\ShowDetailsMatch\ParticipationNotesDTO;

class ShowDetailsMatchJsonDto
{

    public string $firstName;
    public string $lastName;
    public int $numero;
    public array $notes = [];

    public function toDto(ParticipationNotesDTO $dtoEntry) : ShowDetailsMatchJsonDto
    {
        $this->firstName = $dtoEntry->getParticipation()->getPlayer()->getName()->firstName();
        $this->lastName = $dtoEntry->getParticipation()->getPlayer()->getName()->lastName();
        $this->numero = $dtoEntry->getParticipation()->getNumero();

        foreach($dtoEntry->getNotes() as $note){
            $this->notes[] = [
                'minute' => $note->getMinute(),
                'content' => $note->getContent()
            ];
        }

        return $this;
    }
}
