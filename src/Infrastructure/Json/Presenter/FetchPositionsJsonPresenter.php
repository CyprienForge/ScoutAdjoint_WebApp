<?php

namespace Infrastructure\Json\Presenter;

use Domain\Presenter\FetchPositions\FetchPositionsPresenter;
use Domain\Response\FetchPositions\FetchPositionsResponse;
use Infrastructure\Json\Dto\PositionJsonDto;

class FetchPositionsJsonPresenter implements FetchPositionsPresenter
{
    private array $result = [];

    public function present(FetchPositionsResponse $response): void
    {
        foreach ($response->positions as $position) {
            $positionDto = new PositionJsonDto();
            $this->result[] = $positionDto->toDto($position);
        }
    }

    public function getPresentation()
    {
        return $this->result;
    }
}
