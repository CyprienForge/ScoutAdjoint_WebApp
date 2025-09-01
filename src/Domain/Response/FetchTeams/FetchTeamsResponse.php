<?php

namespace Domain\Response\FetchTeams;

class FetchTeamsResponse
{
    public function __construct(
        public array $teams
    ){}
}
