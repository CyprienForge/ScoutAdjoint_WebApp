<?php

namespace Domain\Response\ShowDetailsMatch;

class ShowDetailsMatchResponse
{

    public function __construct(
        public array $participationsNotes,
        public int $selectedTeamId
    ){}

}
