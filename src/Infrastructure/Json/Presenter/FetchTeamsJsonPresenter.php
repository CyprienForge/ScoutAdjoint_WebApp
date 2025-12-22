<?php

namespace Infrastructure\Json\Presenter;

use Domain\Presenter\FetchTeams\FetchTeamsPresenter;
use Domain\Request\FetchTeams\FetchTeamsRequest;
use Domain\Response\FetchTeams\FetchTeamsResponse;
use Infrastructure\Json\Dto\TeamJsonDto;

class FetchTeamsJsonPresenter implements FetchTeamsPresenter
{
    private array $result = [];

    public function present(FetchTeamsResponse $response): void
    {
        foreach($response->teams as $team) {
            $teamJsonDto = new TeamJsonDto();
            $this->result[] = $teamJsonDto->toDto($team);
        }
    }

    public function getPresentation()
    {
        return $this->result;
    }
}
