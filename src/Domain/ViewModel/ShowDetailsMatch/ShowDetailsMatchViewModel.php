<?php

namespace Domain\ViewModel\ShowDetailsMatch;

class ShowDetailsMatchViewModel
{
    public int $idMatch;
    public int $homeTeamId;
    public string $homeTeamName;
    public int $awayTeamId;
    public string $awayTeamName;
    public string $homeTeamSelected;
    public string $awayTeamSelected;

    public array $notesViewModels = [];

    public function getNotesViewModels(): array
    {
        return $this->notesViewModels;
    }
}
